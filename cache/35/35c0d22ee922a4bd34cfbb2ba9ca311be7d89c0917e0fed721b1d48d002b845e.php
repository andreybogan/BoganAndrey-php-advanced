<?php

/* catalog.twig */
class __TwigTemplate_43b84ddbc1598076941e1fae6008d4efde420c328358a902480943e8a26a4e03 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("layout/main.twig", "catalog.twig", 1);
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
  <h1>Каталог товаров</h1>
  <div class=\"catalog\">
    ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["model"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
            // line 8
            echo "      <div class=\"item\">
        <a href=\"index.php?a=card&id=";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["val"], "id", array()), "html", null, true);
            echo "\">
          ";
            // line 10
            if ((twig_get_attribute($this->env, $this->source, $context["val"], "img", array()) != "")) {
                // line 11
                echo "            <img src=\"./images/small/";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["val"], "img", array()), "html", null, true);
                echo "\" alt=\"\">
          ";
            } else {
                // line 13
                echo "            <div class=\"plug\">Фото отсутствует</div>
          ";
            }
            // line 15
            echo "        </a>
        <a href=\"index.php?a=card&id=";
            // line 16
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["val"], "id", array()), "html", null, true);
            echo "\">
          <p>";
            // line 17
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["val"], "name", array()), "html", null, true);
            echo "</p>
        </a>
        <p>Цена ";
            // line 19
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["val"], "price", array()), "html", null, true);
            echo " руб.</p>

        ";
            // line 21
            if (twig_get_attribute($this->env, $this->source, ($context["SESSION"] ?? null), "user", array())) {
                // line 22
                echo "          <form action=\"\" method=\"post\">
            <input type=\"hidden\" name=\"id_prod\" value=\"";
                // line 23
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["val"], "id", array()), "html", null, true);
                echo "\">
            <input type=\"submit\" name=\"submitAddBasket\" class=\"submit\" value=\"Добавить в корзину\">
          </form>
        ";
            }
            // line 27
            echo "      </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "  </div>

";
    }

    public function getTemplateName()
    {
        return "catalog.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 29,  92 => 27,  85 => 23,  82 => 22,  80 => 21,  75 => 19,  70 => 17,  66 => 16,  63 => 15,  59 => 13,  53 => 11,  51 => 10,  47 => 9,  44 => 8,  40 => 7,  35 => 4,  32 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "catalog.twig", "C:\\OSPanel\\domains\\BoganAndrey-php-advanced\\views\\twig\\catalog.twig");
    }
}
