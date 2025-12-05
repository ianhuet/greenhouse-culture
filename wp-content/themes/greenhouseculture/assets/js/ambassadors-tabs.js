document.addEventListener('DOMContentLoaded', () => {
  const tabs = document.querySelectorAll('.tabbed-content .tab');
  const panels = document.querySelectorAll('.tabbed-content .tab-panel');

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
});
