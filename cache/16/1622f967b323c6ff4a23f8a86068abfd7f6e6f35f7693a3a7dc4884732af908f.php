<?php

/* layout/main.twig */
class __TwigTemplate_565b26eae2377aafb18dad6b9efd65661c7eb6766cb95b631aa4bfbd16b67249 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html lang=\"ru\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\"
        content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\">
  <link rel=\"stylesheet\" href=\"./css/style.css\">
  <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>
  <title></title>
</head>
<body>

  ";
        // line 14
        $this->loadTemplate("layout/header.twig", "layout/main.twig", 14)->display($context);
        // line 15
        echo "
  <div class=\"center\">
      ";
        // line 17
        $this->displayBlock('content', $context, $blocks);
        // line 19
        echo "  </div>

  <footer>&copy; AndreyShop :)</footer>
</body>
</html>";
    }

    // line 17
    public function block_content($context, array $blocks = array())
    {
        // line 18
        echo "      ";
    }

    public function getTemplateName()
    {
        return "layout/main.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 18,  55 => 17,  47 => 19,  45 => 17,  41 => 15,  39 => 14,  24 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout/main.twig", "C:\\OSPanel\\domains\\BoganAndrey-php-advanced\\views\\twig\\layout\\main.twig");
    }
}
