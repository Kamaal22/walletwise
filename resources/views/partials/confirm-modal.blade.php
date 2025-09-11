<div id="confirm-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center" aria-hidden="true">
  <div class="absolute inset-0 bg-black/40" onclick="hideConfirmModal()"></div>

  <div class="bg-white rounded-lg shadow-lg max-w-lg w-full mx-4 z-10">
    <div class="p-4 border-b">
      <h3 class="text-lg font-medium">Confirm action</h3>
    </div>

    <div class="p-4" id="confirm-modal-body">
      <p id="confirm-modal-message" class="text-sm text-gray-700">Are you sure you want to perform this action?</p>
      <p class="mt-2 text-xs text-red-600">This action cannot be undone.</p>
    </div>

    <div class="p-4 flex justify-end space-x-2 border-t">
      <button type="button" onclick="hideConfirmModal()" class="px-4 py-2 bg-gray-100 rounded text-sm">Cancel</button>
      <form id="confirm-modal-form" method="POST" action="#">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded text-sm">Delete</button>
      </form>
    </div>
  </div>

  <script>
    function showConfirmModal(message, action) {
      var modal = document.getElementById('confirm-modal');
      var msg = document.getElementById('confirm-modal-message');
      var form = document.getElementById('confirm-modal-form');
      msg.textContent = message || 'Are you sure you want to perform this action?';
      form.action = action || '#';
      modal.classList.remove('hidden');
      modal.setAttribute('aria-hidden', 'false');
      // focus delete button for accessibility
      setTimeout(function(){ form.querySelector('button[type=submit]').focus(); }, 100);
    }

    function hideConfirmModal() {
      var modal = document.getElementById('confirm-modal');
      modal.classList.add('hidden');
      modal.setAttribute('aria-hidden', 'true');
    }

    document.addEventListener('keydown', function(e){
      if (e.key === 'Escape') {
        var modal = document.getElementById('confirm-modal');
        if (modal && !modal.classList.contains('hidden')) hideConfirmModal();
      }
    });
  </script>
</div>
