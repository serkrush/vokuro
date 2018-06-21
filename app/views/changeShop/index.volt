{{ content }}
<form method="post" autocomplete="off">
    <div class="center scaffold">

        <div class="clearfix">
            <label for="nameshop">Name</label>
            {{ form.render("nameshop") }}
        </div>
        <div class="clearfix">
            <label for="adresshop">Name</label>
            {{ form.render("adresshop") }}
        </div>

        <div class="clearfix">
            {{ submit_button("Search", "class": "btn btn-success") }}
        </div>

    </div>
</form>
<div id="resultSearch">
    {{ partial("changeShop/listShop", ['page': page]) }}
</div>