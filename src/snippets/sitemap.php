<?= '<?xml version="1.0" encoding="utf-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($pages as $p): ?>
        <?php if (in_array($p->uri(), $ignore)) continue ?>
        <?php if (in_array($p->intendedTemplate(), $ignore)) continue ?>
        <url>
            <?php if ($p->intendedTemplate() == 'category' || $p->intendedTemplate() == 'calendar'): ?>
                <loc><?= html(site()->url() . '/' . $p->uid()) ?></loc>
            <?php else: ?>
                <loc><?= html($p->url()) ?></loc>
            <?php endif ?>
            <lastmod><?= $p->modified('c') ?></lastmod>

            <?php if ($p->intendedTemplate() == 'about' || $p->intendedTemplate() == 'category' || $p->intendedTemplate() == 'calendar' || $p->intendedTemplate() == 'blog'): ?>
                <priority>0.2</priority>
            <?php else: ?>
                <priority><?= ($p->isHomePage()) ? 1 : number_format(0.5 / $p->depth(), 1) ?></priority>
            <?php endif ?>
        </url>
    <?php endforeach ?>
</urlset>