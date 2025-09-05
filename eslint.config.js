import prettierConfig from 'eslint-config-prettier';
import prettierPlugin from 'eslint-plugin-prettier';

export default [
	{
		files: ['**/*.js'],
		languageOptions: {
			ecmaVersion: 'latest',
			sourceType: 'module',
			globals: {
				$: 'readonly',
				Canvi: 'readonly',
				console: 'readonly',
				CustomEvent: 'readonly',
				document: 'readonly',
				jQuery: 'readonly',
				location: 'readonly',
				navigator: 'readonly',
				window: 'readonly',
				wp: 'readonly',
			},
		},
		plugins: {
			prettier: prettierPlugin,
		},
		rules: {
			'no-undef': 'error',
			'no-unused-vars': 'warn',
			'prefer-const': 'warn',
			'prettier/prettier': 'error',
		},
	},
	{
		ignores: [
			'**/node_modules/**',
			'**/*.min.js',
			'wp-content/themes/greenhouseculture/assets/css/*',
			'wp-content/themes/greenhouseculture/assets/js/*',
			'!wp-content/themes/greenhouseculture/assets/js/custom.js',
			'!wp-content/themes/greenhouseculture/assets/js/script.js',
		],
	},
	prettierConfig,
];
