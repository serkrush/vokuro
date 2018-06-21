<div class="packages-index">
    <style>
        .packages-index #package_list tbody tr{
            cursor: pointer;
        }
    </style>
    {{ content() }}
    <ul class="nav nav-tabs">
        <li><a href="#export_csv" data-toggle="tab">Export CSV</a></li>
        <li><a href="#package_list" data-toggle="tab">Package List</a></li>
        <li class="active"><a href="#productsTab" data-toggle="tab">Products</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane" id="export_csv">
            {{ partial("packages/form") }}
        </div>
        <div class="tab-pane" id="package_list">
            <div class="row">
                <div class="span9">
                    <h2>Packages List</h2>
                    <div id="form-search" class="form-inline">
                        <input id="search_package_id" type="text" class="input-middle clearable" placeholder="Package ID">
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="span12 list">
                    {{ partial("packages/list", ['page': page]) }}
                </div>
            </div>
        </div>
        <div class="tab-pane active" id="productsTab">
            <div class="row">
                <div class="span9">
                    <h2>Products List</h2>
                </div>
                <div class="row">
                    <div class="span12 list" style="padding: 0 22px;">
                        {{ partial("packages/listProducts", ['page': productPage]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
