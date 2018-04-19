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
          {if empty($smarty.session.login) || $smarty.session.expire < time()}
              <h1>Please Login</h1>
              {if $smarty.session.expire < time()}
                <p>Your session is expired.</p>
              {/if}
              {if $view.session.error == true}
                  <div class="alert-danger"><p>Please enter all the necessary information !</p></div>
              {/if}
              <div style="width: 450px; position: relative; top: 30%; margin-top: 30px;">
                  <form action="" method="post">
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
          {else}
              {$smarty.session.expire = time() + 15}
              <h1>Welcome, Mr.{$smarty.session.login}</h1>
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