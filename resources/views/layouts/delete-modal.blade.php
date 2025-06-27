<!-- Modal Konfirmasi Hapus Global -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="fixed inset-0 bg-black opacity-30" style="z-index:49;"></div>
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full" style="z-index:50; position:relative;">
        <div class="flex items-center mb-4">
            <div class="bg-red-100 rounded-full p-2 mr-3">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 4h.01M4.93 4.93a10 10 0 0114.14 0M12 2v2m6.36 1.64l1.42 1.42M20 12h2m-1.64 6.36l-1.42 1.42M12 20v2m-6.36-1.64l-1.42-1.42M4 12H2" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
        </div>
        <p class="text-gray-700 mb-6">Apakah Anda yakin ingin menghapus data ini?</p>
        <form id="deleteModalForm" method="POST" style="display:inline">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" id="deleteModalToken" value="">
    <div class="flex justify-end gap-2">
        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded" onclick="closeDeleteModal()">Batal</button>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Ya, Hapus</button>
    </div>
</form>
    </div>
</div>

<script>
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}
document.addEventListener('DOMContentLoaded', function() {
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    var tokenInput = document.getElementById('deleteModalToken');
    if (csrf && tokenInput) {
        tokenInput.value = csrf;
    }
    // Event tombol hapus
    document.querySelectorAll('.open-delete-modal').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const action = this.getAttribute('data-action');
            const form = document.getElementById('deleteModalForm');
            if (form && action) {
                form.setAttribute('action', action);
                document.getElementById('deleteModal').classList.remove('hidden');
            }
        });
    });
    // Tutup modal jika klik di luar konten modal
    var modal = document.getElementById('deleteModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if(e.target === this) closeDeleteModal();
        });
    }
});
</script>
