<?php
function get_createView($dir, $view) {
  $view = sanitize($view);
  // -- template here ----------------------------
  $template = '%% views/header.html %%

<div class="row">
  <div class="col-lg-12">
    <h1>{{$title}}</h1>
    <p>Replace this with your view contents</p>
  </div>
</div>

%% views/footer.html %%';
  // -- template here ----------------------------
  
  file_put_contents("views/{$view}.php", $template);
  redirect("/");
  exit();
}

function get_createController($controller) {
  $controller = sanitize($controller);

// -- template here ----------------------------
  $template =<<<END
<?php
require_once "include/util.php";
// require_once "models/{$controller}.php";
END;
// -- template here ----------------------------

  file_put_contents("controllers/{$controller}.php", $template);
  redirect("/");
  exit();
}

function get_createFunction($controller, $function) {
  $controller = sanitize($controller);
  $function = sanitize($function);
  $contents = file_get_contents("controllers/{$controller}.php");
  $view = $controller . substr($function, strpos($function, "_") + 1);

// -- template here ----------------------------
  $template =<<<END


function {$function}() {
  // Put your code for {$function} here, something like
  // 1. Load and validate parameters or form contents
  // 2. Query or update the database
  // 3. Render a template or redirect
  renderTemplate(
    "views/{$view}.php",
    array(
      'title' => '{$view}',
    )
  );
}
END;
// -- template here ----------------------------

  // append the new function to the end of the file (before the closing PHP tag, if any)
  $template = preg_replace("/(\A.*)(\?>\s?|\Z)/msU", "$1$template$2", $contents, 1);
  file_put_contents("controllers/{$controller}.php", $template);
  redirect("/");
  exit();
}

function sanitize($str) {
  // sanitize controller and function names
  $str = preg_replace("/([^\w\d_\.])/", '', $str);
  $str = preg_replace("/([\.]{2,})/", ".", $str);
  return $str;
}
