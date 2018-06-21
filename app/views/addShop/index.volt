
    {{ content() }}
    <h2>Create new Shop</h2>


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
                {{ submit_button("Save", "class": "btn btn-success") }}
            </div>

        </div>

    </form>