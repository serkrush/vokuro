{{ content() }}
<style>
    .modal-footer{
        display: none;
    }
</style>
Load image

    <div class="row">
        <div class="span9">
            <h2>Select user</h2>
            <div id="search-user" class="form-inline">
                <input id="search_user_name" type="text" class="input-middle clearable" placeholder="User Name">
            </div>

        </div>
    </div>

    <h2>Selectes user</h2>
    <div>
        <input type="text" name="nameuser" value="" readonly style="border:0;background: transparent;">
        <input type="hidden" name="iduser" value="" readonly style="border:0;background: transparent;">
        <input type="hidden" name="nameavatar" value="" readonly style="border:0;background: transparent;">
    </div>
    <hr style="border-color: #002a80">
<form method="post" enctype="multipart/form-data">
    <input type="file" name="files[]" multiple>
    <input type="submit" value="Send File(s)" class="upload_files">
</form>
<div class="ajax-reply"></div>
