<? require_once($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/header.php"); ?>

<div class="form">
    <form method="post" id="frmFINDBYNAME" action="/recipe">
      <fieldset>
        <legend>Find ingredient by name</legend>
        <div class="row">
          <label for="name">Name:</label>
          <span class="error">*</span>
          <input name="name" id="name" type="text" placeholder="Enter name of ingredient you find for.">
        </div>
        <div class="row">
          <input type="submit" value="Find" placeholder="Enter name of recipe."/>
        </div>
      </fieldset>
    </form>
</div>

<? require_once($_SERVER['DOCUMENT_ROOT'] . "/Public/inc/footer.php"); ?>