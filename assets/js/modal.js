
document.addEventListener('DOMContentLoaded', function() {
  // Handle all open modal buttons
  document.querySelectorAll('[id^="openModal-"]').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const postId = this.id.replace('openModal-', '');
      const modal = document.getElementById('customModal-' + postId);
      const iframe = modal.querySelector('iframe');
      
      modal.classList.add('active');
      
      // Auto-play YouTube video when modal opens
      if (iframe) {
        const src = iframe.src;
        if (src.includes('autoplay=-1')) {
          iframe.src = src.replace('autoplay=-1', 'autoplay=1');
        } else if (!src.includes('autoplay=1')) {
          iframe.src = src + (src.includes('?') ? '&' : '?') + 'autoplay=1';
        }
      }
    });
  });

  // Handle all close modal buttons
  document.querySelectorAll('[id^="closeModal-"]').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const postId = this.id.replace('closeModal-', '');
      const modal = document.getElementById('customModal-' + postId);
      const iframe = modal.querySelector('iframe');
      
      modal.classList.remove('active');
      
      // Stop YouTube video when modal closes
      if (iframe) {
        const src = iframe.src;
        iframe.src = src.replace('autoplay=1', 'autoplay=-1');
        iframe.src = iframe.src; // Force reload to stop video
      }
    });
  });

  // Close when clicking outside modal
  document.querySelectorAll('.modal-overlay').forEach(function(modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        const iframe = modal.querySelector('iframe');
        
        modal.classList.remove('active');
        
        // Stop YouTube video when clicking outside
        if (iframe) {
          const src = iframe.src;
          iframe.src = src.replace('autoplay=1', 'autoplay=-1');
          iframe.src = iframe.src; // Force reload to stop video
        }
      }
    });
  });
});