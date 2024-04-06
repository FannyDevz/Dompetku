<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="filterModalLabel">Filter</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" id="filterForm" method="GET">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ Request::get('name') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea name="note" id="note" class="form-control">{{ Request::get('note') }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="divider">
                                <div class="divider-text">Date Transaction</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <div class="form-group">
                                <label for="date_start">From</label>
                                <input type="date" name="date_start" id="date_start" class="form-control" value="{{ Request::get('date_start') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <div class="form-group">
                                <label for="date_end">To</label>
                                <input type="date" name="date_end" id="date_end" class="form-control" value="{{ Request::get('date_end') }}">
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="divider">
                                <div class="divider-text">Total Transaction</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <div class="form-group">
                                <label for="total_start">From</label>
                                <input type="number" name="total_start" id="total_start" class="form-control" value="{{ Request::get('total_start') }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <div class="form-group">
                                <label for="total_end">To</label>
                                <input type="number" name="total_end" id="total_end" class="form-control" value="{{ Request::get('total_end') }}">
                            </div>
                        </div>
{{--                        <div class="col-12 ">--}}
{{--                            <div class="divider">--}}
{{--                                <div class="divider-text">Date Created</div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-md-6 col-lg-6 ">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="date_created_start">From</label>--}}
{{--                                <input type="date" name="date_created_start" id="date_created_start" class="form-control" value="{{ Request::get('date_created_start') }}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-12 col-md-6 col-lg-6 ">--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="date_created_end">To</label>--}}
{{--                                <input type="date" name="date_created_end" id="date_created_end" class="form-control" value="{{ Request::get('date_created_end') }}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-12 ">
                            <div class="divider">
                                <div class="divider-text">Category</div>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control" >
                                    <option value="" {{ Request::get('type') == '' ? 'selected' : '' }}>All</option>
                                    <option value="income" {{ Request::get('type') == 'income' ? 'selected' : '' }}>Income</option>
                                    <option value="outcome" {{ Request::get('type') == 'outcome' ? 'selected' : '' }}>Outcome</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <div class="form-group">
                                <label for="income">Income</label>
                                <select name="income" id="income" class="form-control" >
                                    <option value="" {{ Request::get('outcome') == '' ? 'selected' : '' }}>All</option>
                                    @foreach($categories_income as $category)
                                        <option value="{{ $category->id }}" {{ Request::get('income') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <div class="form-group">
                                <label for="outcome">Outcome</label>
                                <select name="outcome" id="outcome" class="form-control">
                                    <option value="" {{ Request::get('outcome') == '' ? 'selected' : '' }}>All</option>
                                    @foreach($categories_outcome as $category)
                                        <option value="{{ $category->id }}" {{ Request::get('outcome') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="divider">
                                <div class="divider-text">Show & Sort</div>
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label for="show">Show</label>
                                <select name="show" id="show" class="form-control">
                                    <option value="all" {{ Request::get('show') == 'all' ? 'selected' : '' }}>All</option>
                                    <option value="10" {{ Request::get('show') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ Request::get('show') == '25' ? 'selected' : '' }} >25</option>
                                    <option value="50" {{ Request::get('show') == '50' ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ Request::get('show') == '100' ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <div class="form-group">
                                <label for="by">Sort</label>
                                <select name="by" id="by" class="form-control">
                                    <option value="date" {{ Request::get('by') == 'date' ? 'selected' : '' }}>Date</option>
                                    <option value="name" {{ Request::get('by') == 'name' ? 'selected' : '' }}>Name</option>
                                    <option value="created_at" {{ Request::get('by') == 'created_at' ? 'selected' : '' }}>Date Created</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <div class="form-group">
                                <label for="sort">By</label>
                                <select name="sort" id="sort" class="form-control">
                                    <option value="desc" {{ Request::get('sort') == 'desc' ? 'selected' : '' }}>DESC</option>
                                    <option value="asc" {{ Request::get('sort') == 'asc' ? 'selected' : '' }}>ASC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if (Request::routeIs('recycle-bin.wallet.transactions'))
                        <a type="button" class="btn btn-warning" href="{{ route('recycle-bin.wallet.transactions' , $wallet->id)  }}" >Reset</a>
                    @elseif (Request::routeIs('wallet.transactions'))
                        <a type="button" class="btn btn-warning" href="{{ route('wallet.transactions' , $wallet->id)  }}" >Reset</a>
                    @endif
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
