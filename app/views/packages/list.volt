<table class="table table-striped">
    <thead>
    <tr>
        <th>DID</th>
        <th class="package-id">Package ID</th>
        <th class="user-name">User Name</th>
        <th>Address</th>
        <th>E</th>
        <th>S</th>
        <th>T</th>
        <th>M</th>
        <th>Trans.ID</th>
        <th>Amount</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody>
    {% for item in page.items %}
        {% set table1 = item.getVkTable1() %}
        {% set table2 = item.getVkTable2() %}
        {% set table3 = item.getVkTable3() %}
        {% set table4 = item.getVkTable4() %}
        <tr data-did = "{{ item.getDid() }}">
            <td>{{ item.getDid() }}</td>
            <td>{{ table1.getPackageId() }}</td>
            <td>{{ item.getUsers().name }}</td>
            <td>{{ table2?table2.getFullAddress():"" }}</td>
            <td>{{ table3?table3.getEmail():"" }}</td>
            <td>{{ table3?table3.getSms():""}}</td>
            <td>{{ table3?table3.getTxt():"" }}</td>
            <td>{{ table3?table3.getMail():"" }}</td>
            <td>{{ table4?table4.getTransactionId():"" }}</td>
            <td>{{ table4?locale.number(table4.getAmount()):"" }}</td>
            <td> {{locale.format(table1.getCreatedAt())}} </td>
        </tr>
    {% endfor %}
    </tbody>
</table>

<div class="row">
    <div class="span9">
        {{ partial('pagers/digg', [ 'pager' : page, 'url' : '/packages/index'] ) }}
    </div>
</div>
