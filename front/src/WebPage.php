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
                    <link rel="icon" type="image/png" href="img/favicon.png">
                    <link rel="stylesheet" href="./src/css/style.css" >
                    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
                    

                    {$this->getHead()}
               
                  
            </head>
            <html  lang="fr">
                <body>
                    <header>
                        <nav class="navbar">
                            <img id="logo" src="src/img/bourse.png" alt="">
                            <h1>PigStock</h1>
                                <ul class="items">
                                    <li><a href="home" class="accueil">Accueil</a></li>
                                    <li><a href="history" class="history">Historique</a></li>
                                    <li><a href="forum" class="forum">Forum</a></li>
                                    <li><a href="dashboard" class="dashboard">Dashboard</a></li>
                                </ul>
                            </nav>
                    </header>
                
                    <div class="content">
                    
                        <!-- Contenu de votre page -->
                        {$this->getBody()}
                    </div>
                    <script src="./src/js/nav.js"></script>
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
