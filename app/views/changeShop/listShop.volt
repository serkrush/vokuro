    <style>
        .statusRec{
            display: none;
        }
        .statusRec.check{
            color: green;
            display: block;
        }
        .modal-footer{
            display: none;
        }
        .green{
            background: green;
        }
        th.ordered{
            cursor: pointer;
        }
        th.ordered:hover{
            background: rgba(128, 128, 128, 0.12);
        }

        table th.asc .divOrder, table th.desc .divOrder {
            background: url(img/arrow.png) center no-repeat;
            background-size: cover;
            width: 17px;
            height: 20px;
            float: right;
        }
        table th .divOrder {
            background: url(img/arrow.png) center no-repeat;
            background-size: cover;
            width: 34px;
            height: 20px;
            float: right;
        }
        table th.asc .divOrder {
            background-position-x: 0px;
        }
        table th.desc .divOrder {
            background-position-x: -17px;
        }
    </style>
    {#{{ orderByColumn }}#}
    {#{{ orderByDirection }}#}
    <table id="table-id" class="table table-striped">
        <thead>
        <tr>
            <th class="ordered" data-order-by="nameshop" data-order-dir={% if orderByColumn === 'nameshop' %} "{{ orderByDirection }}" {% endif  %}>
                Shop Name
                <div class="divOrder"></div>
            </th>
            <th class="ordered" data-order-by="adresshop" data-order-dir={% if orderByColumn === 'adresshop' %} "{{ orderByDirection }}" {% endif  %}>
                Shop Address
                <div class="divOrder"></div>
            </th>
        </tr>
        </thead>
        <tbody>
        {% for item in page.items %}
            <tr data-shop-id = "{{ item.getIdshop() }}">
                <td>
                    <input type="text" class="inputNameshop" value="{{ item.getNameshop() }}">
                </td>
                <td><input type="text" class="inputAdresshop" value="{{ item.getAdresshop() }}"></td>
                <td>{{ link_to(item.getIdshop(), '<i class="icon-pencil"></i> Edit', "class": "btn upd") }}</td>
                {#<td>{{ link_to("changeShop/delete/" ~ item.getIdshop(), '<i class="icon-remove"></i> Delete', "class": "btn del") }}</td>#}
                <td>{{ link_to(item.getIdshop(), '<i class="icon-remove"></i> Delete', "class": "btn del") }}</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>

    <div class="row" style="background: grey;">
        <div class="span9">
            {{ partial('pagers/digg', [ 'pager' : page, 'url' : '/changeShop/index'] ) }}
        </div>
    </div>