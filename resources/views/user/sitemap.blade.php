<?xml version="1.0" encoding="UTF-8"?>
<urlset
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
	http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- created by Ho HOang Son -->
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <lastmod>{{ date('c') }}</lastmod>
        <priority>0.8</priority>
    </url>
    @if($categories)
        @foreach($categories as $category)
            <url>
                <loc>{{ route('category.list.index',$category->alias) }}</loc>
                <changefreq>monthly</changefreq>
                <lastmod>{{ $category->updated_at->format('c')  }}</lastmod>
                <priority>0.6</priority>
            </url>
        @endforeach
    @endif
    @if($authors)
        @foreach($authors as $author)
            <url>
                <loc>{{ route('author.list.index',$author->alias) }}</loc>
                <changefreq>monthly</changefreq>
                <lastmod>{{ $author->updated_at->format('c')  }}</lastmod>
                <priority>0.6</priority>
            </url>
        @endforeach
    @endif
    @if($stories)
        @foreach($stories as $story)
            <url>
                <loc>{{ route('story.show',$story->alias) }}</loc>
                <changefreq>weekly</changefreq>
                <lastmod>{{ $story->updated_at->format('c')  }}</lastmod>
                <priority>0.8</priority>
            </url>
        @endforeach
    @endif
</urlset>
