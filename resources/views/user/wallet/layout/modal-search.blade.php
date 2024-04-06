<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="searchModalLabel">Search</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="GET">
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
                                <div class="divider-text">Show & Sort</div>
                            </div>
                        </div>
                        <div class="col-12">
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
                                <label for="sort">Sort</label>
                                <select name="sort" id="sort" class="form-control">
                                    <option value="id" {{ Request::get('sort') == 'id' ? 'selected' : '' }}>ID</option>
                                    <option value="name" {{ Request::get('sort') == 'name' ? 'selected' : '' }}>Name</option>
                                    <option value="date" {{ Request::get('sort') == 'date' ? 'selected' : '' }}>Date</option>
                                    <option value="created_at" {{ Request::get('sort') == 'created_at' ? 'selected' : '' }}>Date Created</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 ">
                            <div class="form-group">
                                <label for="by">By</label>
                                <select name="by" id="by" class="form-control">
                                    <option value="desc" {{ Request::get('by') == 'desc' ? 'selected' : '' }}>DESC</option>
                                    <option value="asc" {{ Request::get('by') == 'asc' ? 'selected' : '' }}>ASC</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
