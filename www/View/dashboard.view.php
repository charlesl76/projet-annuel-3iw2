<h1>Tableau de bord</h1>

<div class="dashboard">
    <div class="recap">
        <h2 id="recap-highlight">Welcome <?= $user->getUsername(). ' '.$user->getLastName()?></h2>
        <span>The site actually contains :</span>
        <div class="grid">
            <div class="articles-recap w-50">
                <span id="logo-articles" class="icon-recap"></span>
                <span class="recap-text"><a href="/articles"><?= count($articles) ?> articles</a></span>
            </div>
            <div class="pages-recap w-50">
                <span id="logo-pages" class="icon-recap"></span>
                <span class="recap-text"><a href="/pages"><?= count($pages) ?> pages</a></span>
            </div>
            <div class="comments-recap w-50">
                <span id="logo-comments" class="icon-recap"></span>
                <span class="recap-text"><a href="/comments"><?= count($comments) ?> comments</a></span>
            </div>
            <div class="tags-recap w-50">
                <span id="logo-tags" class="icon-recap"></span>
                <span class="recap-text"><a href="/tags"><?= count($tags) ?> categories</a></span>
            </div>
        </div>

    </div>
</div>

<style>
    .dashboard {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
        gap: 10%;
    }

    .recap {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
        width: 40%;
        background: #fff;
        box-shadow: 3px 4px 14px rgba(0, 0, 0, 0.25);
        border-radius: 4px;
    }

    .recap>span {

        display: flex;
        width: 80%;
    }

    .grid {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: 80%;
        background: #80D6FF;
        border-radius: 4px;
        margin: 1rem;
    }

    .recap-text {
        display: flex;
        align-items: center;
        color: white;
        font-size: 1rem;
        font-weight: bold;
    }

    .recap-text > a {
        color: white;
        text-decoration: none;
    }

    .w-50 {
        display: flex;
        width: 50%;
    }

    #recap-highlight {
        font-size: 1.5rem;
        color: black;
        font-weight: 600;
    }

    .icon-recap {
        width: 42px;
        height: 42px;
        margin: 16px 4px 16px 16px;
    }

    #logo-articles {
        background-color: white;
        -webkit-mask-image: url('/dist/article_black_24dp.svg');
        mask-image: url('/dist/article_black_24dp.svg');
        background-position: center;
    }

    #logo-pages {
        background-color: white;
        -webkit-mask-image: url('/dist/layers_black_24dp.svg');
        mask-image: url('/dist/layers_black_24dp.svg');
        background-position: center;
    }

    #logo-comments {
        background-color: white;
        -webkit-mask-image: url('/dist/question_answer_black_24dp.svg');
        mask-image: url('/dist/question_answer_black_24dp.svg');
        background-position: center;
    }

    #logo-tags {
        background-color: white;
        -webkit-mask-image: url('/dist/perm_media_black_24dp.svg');
        mask-image: url('/dist/perm_media_black_24dp.svg');
        background-position: center;
    }
</style>