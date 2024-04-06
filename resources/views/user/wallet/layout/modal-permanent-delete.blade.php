<div class="modal fade" id="deletePermanentModal{{ $wallet->id }}" tabindex="-1" aria-labelledby="deletePermanentModalLabel{{ $wallet->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="deletePermanentModalLabel{{ $wallet->id }}">Konfirmasi Delete Permanent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus permanen wallet ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('recycle-bin.wallet.delete', ['id' => $wallet->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Permanent</button>
                </form>
            </div>
        </div>
    </div>
</div>
