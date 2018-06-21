<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th class="package-id">SKU</th>
        <th class="user-name">Product Name</th>
        <th class="user-name">Package ID</th>
        <th>Price</th>
        <th>Count</th>
    </tr>
    </thead>
    <tbody>
    {% for item in page.items %}
        <tr data-product-id = "{{ item.getProductId() }}">
            <td>{{ item.getProductId() }}</td>
            <td>SKU</td>
            <td>{{ item.getProductName() }}</td>
            <td>{{ item.getPackage().getPackageId() }}</td>
            <td>{{ item.getPrice() }}</td>
            <td>{{ item.getProductCount() }}</td>
        </tr>
    {% endfor %}
    </tbody>
</table>

<div class="row" style="background: grey;">
    <div class="span9">
        {{ partial('pagers/digg', [ 'pager' : page, 'url' : '/packages/index'] ) }}
    </div>
</div>
