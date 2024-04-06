
<div class="modal fade" id="detailModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $transaction->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $transaction->id }}">Detail Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('transaction.update' , $transaction->id)}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $transaction->name }}" {{Request::routeIs('recycle-bin.wallet.transactions') ? 'readonly' : ''}}>
                            </div>
                        </div>
                        <div class="col-12  col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" name="amount" id="amount" class="form-control" value="{{ $transaction->amount }}" {{Request::routeIs('recycle-bin.wallet.transactions') ? 'readonly' : ''}}>
                            </div>
                        </div>

                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="date">Date Transaction</label>
                                <input type="date" name="date" id="date" class="form-control" value="{{ $transaction->date }}" {{Request::routeIs('recycle-bin.wallet.transactions') ? 'readonly' : ''}}>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea name="note" id="note" class="form-control" rows="3" {{Request::routeIs('recycle-bin.wallet.transactions') ? 'readonly' : ''}}>{{ $transaction->note }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control" disabled>
                                    <option value="income" {{ $transaction->category_type == 'Income' ? 'selected' : '' }}>Income</option>
                                    <option value="outcome" {{ $transaction->category_type == 'Outcome' ? 'selected' : '' }}>Outcome</option>
                                </select>
                            </div>
                        </div>
                        @if ( $transaction->category_type == 'Income')
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control" {{Request::routeIs('recycle-bin.wallet.transactions') ? 'disabled' : ''}}>
                                        @foreach( $categories_income as $category)
                                            <option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                 </div>
                            </div>
                        @elseif($transaction->category_type == 'Outcome')
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control" {{Request::routeIs('recycle-bin.wallet.transactions') ? 'disabled' : ''}}>
                                        @foreach( $categories_outcome as $category)
                                            <option value="{{ $category->id }}" {{ $transaction->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if (Request::routeIs('wallet.transactions'))
                        <button type="submit" class="btn btn-primary">Save</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
