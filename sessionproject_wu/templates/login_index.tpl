<!DOCTYPE html>
<html lang="en">

{if isset($view.headjs)}
{include file='headjs.tpl'}
{else}
{include file='head.tpl'}
{/if}

  <body>
  {include file='navbar.tpl'}

    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
          {foreach from=$view.navMenu key=navMenuEntry item=navMenuLink}
            <li><a href="{$navMenuLink}">{$navMenuEntry}</a></li>
          {/foreach}
          </ul>
        </div>

      <div id="pageBody">
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          {if !$baseConfig['URLBASEADDR'] + "index.php/login/checkValidSession"}
              <h1>Please Login</h1>
              <div style="width: 450px; position: relative; top: 30%; margin-top: 30px;">
                  <form action="{$baseConfig['URLBASEADDR']}index.php/login/checkPassword" method="post">
                      <div class="form-group">
                          <label for="account">Account</label>
                          <input type="text" name="account" class="form-control" id="account" placeholder="Enter account">
                      </div>
                      <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
              </div>
          {elseif isset($_SESSION['expire']) && $_SESSION['expire'] < time()}
              <script>alert("Your session is expired")</script>
              <meta http-equiv="refresh" content="0.2;url=#">
          {else}
              {$_SESSION['expire'] = time() + 10}
              <h1>Welcome, Mr.{$_SESSION["account"]}</h1>
          {/if}
          </div>
      </div> <!-- END pageBody -->

{if $view.bodyjs == 1}
{include file='bodyjs.tpl'}
{/if}

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    
  </body>
</html>