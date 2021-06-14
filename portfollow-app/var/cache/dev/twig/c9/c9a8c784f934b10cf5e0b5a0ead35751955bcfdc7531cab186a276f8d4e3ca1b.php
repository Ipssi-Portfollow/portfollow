<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* security/login.html.twig */
class __TwigTemplate_d1ab8b5d271bc5b2222b4d6f0a124646517c196bcc2fa9570fabda67742102e6 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "security/login.html.twig"));

        // line 1
        echo "
";
        // line 2
        echo twig_include($this->env, $context, "header/header.html.twig");
        echo "

";
        // line 4
        $this->displayBlock('body', $context, $blocks);
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 5
        echo "
<style>
    body{
        background-image: url(\"";
        // line 8
        echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("images/fond.jpg"), "html", null, true);
        echo "\");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: 50% 50%;
    }

</style>


<div class=\"form-connexion\">

    <form method=\"post\" class=\"f-insc\">
        ";
        // line 20
        if ((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 20, $this->source); })())) {
            // line 21
            echo "            <div class=\"alert alert-danger\">";
            echo twig_escape_filter($this->env, $this->extensions['Symfony\Bridge\Twig\Extension\TranslationExtension']->trans(twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 21, $this->source); })()), "messageKey", [], "any", false, false, false, 21), twig_get_attribute($this->env, $this->source, (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 21, $this->source); })()), "messageData", [], "any", false, false, false, 21), "security"), "html", null, true);
            echo "</div>
        ";
        }
        // line 23
        echo "
        ";
        // line 24
        if (twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 24, $this->source); })()), "user", [], "any", false, false, false, 24)) {
            // line 25
            echo "            <div class=\"mb-3\">
                You are logged in as ";
            // line 26
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 26, $this->source); })()), "user", [], "any", false, false, false, 26), "username", [], "any", false, false, false, 26), "html", null, true);
            echo ", <a href=\"";
            echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_logout");
            echo "\">Logout</a>
            </div>
        ";
        }
        // line 29
        echo "
        

        <h1 style=\"text-align: center; font-size: 24px;\">Portfollow</h1>

        <div class=\"mail-section\">
            <input type=\"text\" value=\"";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 35, $this->source); })()), "html", null, true);
        echo "\" name=\"mail\" id=\"inputMail\"required>
            <label for=\"inputMail\" class=\"mail\"><span class=\"content-name\">Email</span></label>
        </div>

        <div class=\"mail-section\">
            <input type=\"password\" name=\"password\" id=\"inputPassword\" required>
            <label for=\"inputPassword\" class=\"mail\"><span class=\"content-name\">Mot de passe</span></label>
        </div>
        

        <input type=\"hidden\" name=\"_csrf_token\"
            value=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        echo "\"
        >
        <br><br>
        <button class=\"btn btn-lg btn-primary\" type=\"submit\" style=\"width: 100%;\">
            Connexion
        </button>

        <br><br>
        <div style = \"text-align: center\">
            <p>Vous n'avez pas de compte ? <br><a href=\"";
        // line 55
        echo $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("user_registration");
        echo "\">Inscrivez-vous</a></p>
        </div>
    </form>
</div>
";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "security/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 55,  137 => 46,  123 => 35,  115 => 29,  107 => 26,  104 => 25,  102 => 24,  99 => 23,  93 => 21,  91 => 20,  76 => 8,  71 => 5,  52 => 4,  47 => 2,  44 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
{{ include('header/header.html.twig') }}

{% block body %}

<style>
    body{
        background-image: url(\"{{ asset('images/fond.jpg') }}\");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: 50% 50%;
    }

</style>


<div class=\"form-connexion\">

    <form method=\"post\" class=\"f-insc\">
        {% if error %}
            <div class=\"alert alert-danger\">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
        {% endif %}

        {% if app.user %}
            <div class=\"mb-3\">
                You are logged in as {{ app.user.username }}, <a href=\"{{ path('app_logout') }}\">Logout</a>
            </div>
        {% endif %}

        

        <h1 style=\"text-align: center; font-size: 24px;\">Portfollow</h1>

        <div class=\"mail-section\">
            <input type=\"text\" value=\"{{ last_username }}\" name=\"mail\" id=\"inputMail\"required>
            <label for=\"inputMail\" class=\"mail\"><span class=\"content-name\">Email</span></label>
        </div>

        <div class=\"mail-section\">
            <input type=\"password\" name=\"password\" id=\"inputPassword\" required>
            <label for=\"inputPassword\" class=\"mail\"><span class=\"content-name\">Mot de passe</span></label>
        </div>
        

        <input type=\"hidden\" name=\"_csrf_token\"
            value=\"{{ csrf_token('authenticate') }}\"
        >
        <br><br>
        <button class=\"btn btn-lg btn-primary\" type=\"submit\" style=\"width: 100%;\">
            Connexion
        </button>

        <br><br>
        <div style = \"text-align: center\">
            <p>Vous n'avez pas de compte ? <br><a href=\"{{ path('user_registration') }}\">Inscrivez-vous</a></p>
        </div>
    </form>
</div>
{% endblock %}
", "security/login.html.twig", "/Users/abdoulayetraore/portfollow/portfollow-app/templates/security/login.html.twig");
    }
}
