<?php

declare(strict_types=1);

class WebPage
{
    /**
     * Texte compris entre \<head\> et \</head\>.
     *
     * @var string $head
     */
    private string $head = '';

    /**
     * Texte compris entre \<title\> et \</title\>.
     *
     * @var string $title
     */
    private string $title = '';

    /**
     * Texte compris entre \<body\> et \</body\>.
     *
     * @var string $body
     */
    private string $body = '';

    /**
     * Texte compris entre \<body\> et \</body\>.
     *
     * @var string $js
     */
    private string $js = '';

    /**
     * Constructeur.
     *
     * @param string $title Titre de la page
     */
    public function __construct(string $title = '')
    {
        $this->setTitle($title);
    }

    /**
     * Retourner le contenu de $this->body.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Retourner le contenu de $this->head.
     *
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    public function getJS(): string
    {
        return $this->js;
    }


    /**
     * Retourner le contenu de $this->title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Affecter le titre de la page.
     *
     * @param string $title Le titre
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Ajouter un contenu dans $this->head.
     *
     * @param string $content Le contenu à ajouter
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * Ajouter un contenu CSS dans $this->head.
     *
     * @param string $css Le contenu CSS à ajouter
     * @see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendCss(string $css): void
    {
        $this->appendToHead(<<<HTML
            <style type='text/css'>
            {$css}
            </style>
        HTML);
    }

    /**
     * Ajouter l'URL d'un script CSS dans $this->head.
     *
     * @param string $url L'URL du script CSS
     * @see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendCssUrl(string $url): void
    {
        $this->appendToHead(<<<HTML
            <link rel="stylesheet" type="text/css" href="{$url}">
        HTML);
    }

    /**
     * Ajouter un contenu JavaScript dans $this->head.
     *
     * @param string $js Le contenu JavaScript à ajouter
     * @see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendJs(string $js): void
    {
        $this->appendToHead(<<<HTML
        <script type='text/javascript'>
        {$js}
        </script>
        HTML);
    }

    /**
     * Ajouter l'URL d'un script JavaScript dans $this->head.
     *
     * @param string $url L'URL du script JavaScript
     * @see WebPage::appendToHead(string $content) : void
     *
     */
    public function appendJsUrl(string $url): void
    {
        $this->appendToJS(<<<HTML
        <script type='' src='{$url}'></script>
    HTML);
    }

    public function appendToJS(string $content): void
    {
        $this->js .= $content;
    }

    /**
     * Ajouter un contenu dans $this->body.
     *
     * @param string $content Le contenu à ajouter
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    /**
     * Produire la page Web complète.
     *
     * @return string
     *
     * @throws Exception si title n'est pas défini
     */
    public function toHTML(): string
    {
        if (empty($this->title)) {
            throw new Exception(__CLASS__ . ': title not set');
        }

        return <<<HTML
            <!doctype html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <title>{$this->getTitle()}</title>
                <link rel="icon" type="image/png" href="src/img/bourse.png">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                <link rel="stylesheet" href="./src/css/style.css" >
                <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
                    {$this->getHead()}
            </head>
            <html lang="fr">
                <body>
                    <header>
                        <nav class="navbar navbar-expand-sm navbar-light bg-light">
                            <a class="navbar-brand" href="/projet-web-scraping/front/home">
                                <img src="src/img/bourse.png" width="30" height="30" class="d-inline-block align-top" alt="">
                                PigStock
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav">
                                    <a class="nav-item nav-link accueil" href="home">Accueil</a>
                                    <a class="nav-item nav-link history" href="history">Historique</a>
                                    <a class="nav-item nav-link forum" href="forum">Forum</a>
                                    <a class="nav-item nav-link dashboard" href="dashboard">Dashboard</a>
                                </div>
                            </div>
                        </nav>
                    </header>
                
                    <div class="content">
                    
                        <!-- Contenu de votre page -->
                        {$this->getBody()}
                    </div>
                    <script src="./src/js/nav.js"></script>
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                </body>
            </html>
        HTML;
    }

    /**
     * Protéger les caractères spéciaux pouvant dégrader la page Web.
     *
     * @param string $string La chaîne à protéger
     *
     * @return string La chaîne protégée
     *
     * @see https://www.net/manual/en/function.htmlspecialchars
     */
    public static function escapeString(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'utf-8');
    }



    
}
