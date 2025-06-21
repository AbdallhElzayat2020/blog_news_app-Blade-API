<div class="card-body">
    <form action="{{ url()->current() }}" method="get">
        <div class="row">

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="sort_by">Sorting</label>
                    <select class="form-control" name="sort_by" id="sort_by">
                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>Id</option>
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Created_at
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="order_by">Order By</label>
                    <select class="form-control" name="order_by" id="order_by">
                        <option value="asc" {{ request('order_by') == 'asc' ? 'selected' : '' }}>ASC</option>
                        <option value="desc" {{ request('order_by') == 'desc' ? 'selected' : '' }}>DESC</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="limit_by">Limit By</label>
                    <select class="form-control" name="limit_by" id="per_page">
                        <option value="5" {{ request('limit_by') == '5' ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('limit_by') == '10' ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('limit_by') == '20' ? 'selected' : '' }}>20</option>
                        <option value="30" {{ request('limit_by') == '30' ? 'selected' : '' }}>30</option>
                        <option value="50" {{ request('limit_by') == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('limit_by') == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="">All</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Not Active
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label for="keyword">Search</label>
                    <input type="search" name="keyword" class="form-control" placeholder="search here" id="keyword"
                           value="{{ request('keyword') }}">
                </div>
            </div>

            <div class="col-lg-1">
                <label for="">-Search</label>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>
