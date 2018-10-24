<?php

/* layout/header.twig */
class __TwigTemplate_5187eb55f234d953d06a139cd6d563eb41292072a916a5ad374792ce6b7974ac extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<header>
  <div class=\"shop_name\">AndreyShop :)</div>
  <div>

    ";
        // line 5
        if (twig_get_attribute($this->env, $this->source, ($context["_SESSION"] ?? null), "user", array())) {
            // line 6
            echo "      <a href=\"/basket\" class=\"link_button\">
        <button>Корзина</button>
      </a>

      <a href=\"/user\" class=\"link_button\">
        <button>Личная страница</button>
      </a>

      <a href=\"/orders\" class=\"link_button\">
        <button>Заказы</button>
      </a>

      <a href=\"/admin\" class=\"link_button\">
        <button>Админка</button>
      </a>

      <form action=\"\" method=\"post\" style=\"display: inline-block;\">
        <input type=\"submit\" name=\"logout\" value=\"Выйти\" style=\"width: auto;\">
      </form>
    ";
        } else {
            // line 26
            echo "      <a href=\"/user/login\" class=\"link_button\">
        <button>Войти</button>
      </a>

      <a href=\"/user/register\" class=\"link_button\">
        <button>Регистрация</button>
      </a>
    ";
        }
        // line 34
        echo "
  </div>
</header>";
    }

    public function getTemplateName()
    {
        return "layout/header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 34,  53 => 26,  31 => 6,  29 => 5,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout/header.twig", "C:\\OSPanel\\domains\\BoganAndrey-php-advanced\\views\\twig\\layout\\header.twig");
    }
}
