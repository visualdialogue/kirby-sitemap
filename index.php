<?php
/**
 *
 * Sitemap for Kirby 3
 * Based on Kirby 3 cookbook recipe, https://getkirby.com/docs/cookbook/content/sitemap
 *
 * @version   0.0.1
 * @author    Luke Hatfield <https://visualdialogue.com>
 * @copyright Visual Dialogue <https://visualdialogue.com>
 * @license   MIT <http://opensource.org/licenses/MIT>
 */

namespace visualdialogue\Sitemap;

\Kirby::plugin('visualdialogue/sitemap', [

    'options' => [
        'ignore' => ['categories', 'contact', 'event', 'history', 'list', 'members', 'member', 'miscellaneous', 'press', 'error']
    ],

    'routes' => [
        [
            'pattern' => 'sitemap.xml',
            'action'  => function() {
                $pages = site()->pages()->index();

                // fetch the pages to ignore from the config settings,
                // if nothing is set, we ignore the error page
                // $ignore = kirby()->option('sitemap.ignore', ['error']);
                $ignore = kirby()->option('visualdialogue.sitemap.ignore', ['error']);

                $content = snippet('sitemap', compact('pages', 'ignore'), true);

                // return response with correct header type
                return new \Kirby\Cms\Response($content, 'application/xml');
                // return kirby()->response($content, 'application/xml');
            }
        ],
        [
            'pattern' => 'sitemap',
            'action'  => function() {
              return go('sitemap.xml', 301);
            }
        ]
    ],

    'snippets' => [
        // as template too so can get json as content representation easily
       'sitemap'       => __DIR__ . '/src/snippets/sitemap.php',
    ]

]);