
document.addEventListener('DOMContentLoaded', function() {
  // Handle all open modal buttons
  document.querySelectorAll('[id^="openModal-"]').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const postId = this.id.replace('openModal-', '');
      const modal = document.getElementById('customModal-' + postId);
      modal.classList.add('active');
    });
  });

  // Handle all close modal buttons
  document.querySelectorAll('[id^="closeModal-"]').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const postId = this.id.replace('closeModal-', '');
      const modal = document.getElementById('customModal-' + postId);
      modal.classList.remove('active');
    });
  });

  // Close when clicking outside modal
  document.querySelectorAll('.modal-overlay').forEach(function(modal) {
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        modal.classList.remove('active');
      }
    });
  });
});