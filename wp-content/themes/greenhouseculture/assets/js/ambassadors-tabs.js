document.addEventListener('DOMContentLoaded', () => {
  const tabs = document.querySelectorAll('.bap-tabbed-content .tab');
  const panels = document.querySelectorAll('.bap-tabbed-content .tab-panel');

  tabs.forEach(tab => {
    tab.addEventListener('click', () => {
      const targetId = tab.getAttribute('data-tab');

      tabs.forEach(t => t.classList.remove('active'));
      panels.forEach(p => p.classList.remove('active'));

      tab.classList.add('active');
      const targetPanel = document.getElementById(targetId);
      if (targetPanel) {
        targetPanel.classList.add('active');
      }
    });
  });

  document.querySelectorAll('.bap-media-video').forEach(container => {
    const youtubeId = container.dataset.youtubeId;
    const video = container.querySelector('video');

    if (!youtubeId && !video) return;

    const playButton = document.createElement('div');
    playButton.className = 'bap-play-button';
    container.appendChild(playButton);

    if (youtubeId) {
      container.addEventListener('click', () => {
        const iframe = document.createElement('iframe');
        iframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0`;
        iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
        iframe.allowFullscreen = true;
        container.innerHTML = '';
        container.appendChild(iframe);
        container.classList.add('playing');
      });
    } else if (video) {
      container.addEventListener('click', () => {
        if (video.paused) {
          video.play();
          video.controls = true;
          container.classList.add('playing');
        }
      });
    }
  });
});
