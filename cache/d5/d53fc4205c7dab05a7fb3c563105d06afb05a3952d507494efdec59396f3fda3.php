<?php

/* card.twig */
class __TwigTemplate_3691e35e4b6b906e9395b9f619afcefb89441321c9e596a286c00b16d743bc0c extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("layout/main.twig", "card.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout/main.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
  <a href=\"/\">Вернуться в каталог товаров.</a>

  <h1>";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["model"] ?? null), "name", array()), "html", null, true);
        echo "</h1>
  <p>";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["model"] ?? null), "text", array()), "html", null, true);
        echo "</p>
  <p>Цена: ";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["model"] ?? null), "price", array()), "html", null, true);
        echo "</p>

  ";
        // line 11
        if (twig_get_attribute($this->env, $this->source, ($context["SESSION"] ?? null), "user", array())) {
            // line 12
            echo "    <form action=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["_SERVER"] ?? null), "REQUEST_URI", array()), "html", null, true);
            echo "\" method=\"post\" style=\"margin-bottom: 36px\">
      <input type=\"hidden\" name=\"id\" value=\"";
            // line 13
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["model"] ?? null), "id", array()), "html", null, true);
            echo "\">
      <input type=\"submit\" name=\"submitAddBasket\" class=\"submit\" value=\"Добавить в корзину\">
    </form>
  ";
        }
        // line 17
        echo "
  ";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["modelImg"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
            // line 19
            echo "    <a href=\"../../../images/big/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["val"], "img", array()), "html", null, true);
            echo "\" target=\"_blank\"
       style=\"display: inline-block;\">
      <img src=\"../../../images/small/";
            // line 21
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["val"], "img", array()), "html", null, true);
            echo "\" alt=\"\">
    </a>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "
";
    }

    public function getTemplateName()
    {
        return "card.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 24,  80 => 21,  74 => 19,  70 => 18,  67 => 17,  60 => 13,  55 => 12,  53 => 11,  48 => 9,  44 => 8,  40 => 7,  35 => 4,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "card.twig", "C:\\OSPanel\\domains\\BoganAndrey-php-advanced\\views\\twig\\card.twig");
    }
}
