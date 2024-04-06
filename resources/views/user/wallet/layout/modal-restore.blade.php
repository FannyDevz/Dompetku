<div class="modal fade" id="restoreModal{{ $wallet->id }}" tabindex="-1" aria-labelledby="restoreModalLabel{{ $wallet->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h6 class="modal-title white" id="restoreModalLabel{{ $wallet->id }}">Konfirmasi Restore</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengembalikan wallet ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('recycle-bin.wallet.restore', ['id' => $wallet->id]) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-primary">Restore</button>
                </form>
            </div>
        </div>
    </div>
</div>
