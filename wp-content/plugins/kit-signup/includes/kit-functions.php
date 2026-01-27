<?php

if (!defined('ABSPATH')) exit;

function kit_signup_create_subscriber($email, $firstName) {
    $response = wp_remote_post('https://api.kit.com/v4/subscribers', [
        'headers' => [
            'Content-Type' => 'application/json',
            'X-Kit-Api-Key' => KIT_SIGNUP_API_KEY
        ],
        'body' => json_encode([
            'email_address' => $email,
            'first_name' => $firstName,
            'state' => 'active'
        ]),
        'timeout' => 15
    ]);

    if (is_wp_error($response)) {
        return ['success' => false, 'error' => $response->get_error_message()];
    }

    $code = wp_remote_retrieve_response_code($response);
    $body = json_decode(wp_remote_retrieve_body($response), true);

    if ($code === 200 || $code === 201) {
        return ['success' => true, 'data' => $body];
    }

    return ['success' => false, 'error' => $body['message'] ?? 'Failed to create subscriber'];
}

function kit_signup_add_to_form($email) {
    $url = 'https://api.kit.com/v4/forms/' . KIT_SIGNUP_FORM_ID . '/subscribers';

    $response = wp_remote_post($url, [
        'headers' => [
            'Content-Type' => 'application/json',
            'X-Kit-Api-Key' => KIT_SIGNUP_API_KEY
        ],
        'body' => json_encode([
            'email_address' => $email
        ]),
        'timeout' => 15
    ]);

    if (is_wp_error($response)) {
        return ['success' => false, 'error' => $response->get_error_message()];
    }

    $code = wp_remote_retrieve_response_code($response);
    $body = json_decode(wp_remote_retrieve_body($response), true);

    if ($code === 200 || $code === 201) {
        return ['success' => true, 'data' => $body];
    }

    if ($code === 404) {
        return ['success' => false, 'error' => 'Form not found'];
    }

    return ['success' => false, 'error' => $body['message'] ?? 'Failed to add to form'];
}

function kit_signup_handle_ajax() {
    if (!check_ajax_referer('kit_signup_nonce', 'nonce', false)) {
        wp_send_json_error(['message' => 'Invalid security token']);
    }

    $honeypot = sanitize_text_field($_POST['website'] ?? '');
    if (!empty($honeypot)) {
        wp_send_json_error(['message' => KIT_SIGNUP_MESSAGE_ERROR]);
    }

    $email = sanitize_email($_POST['email'] ?? '');
    $firstName = sanitize_text_field($_POST['first_name'] ?? '');

    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Please enter a valid email address']);
    }

    if (empty($firstName)) {
        wp_send_json_error(['message' => 'Please enter your first name']);
    }

    $subscriberResult = kit_signup_create_subscriber($email, $firstName);
    if (!$subscriberResult['success']) {
        wp_send_json_error(['message' => KIT_SIGNUP_MESSAGE_ERROR]);
    }

    $formResult = kit_signup_add_to_form($email);
    if (!$formResult['success']) {
        wp_send_json_error(['message' => KIT_SIGNUP_MESSAGE_ERROR]);
    }

    wp_send_json_success(['message' => KIT_SIGNUP_MESSAGE_SUCCESS]);
}
