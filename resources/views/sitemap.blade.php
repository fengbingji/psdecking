<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>{{request()->root()}}</loc>
    <lastmod>{{date('Y-m-d\Th:i:s+08:00')}}</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>
  @foreach($products as $item)
    <url>
      <loc>{{request()->root()}}/{{$item['category']['parent']['slug']}}/pro-{{$item['category']['slug']}}/{{$item['id']}}.html</loc>
      <lastmod>{{date('Y-m-d\Th:i:s+08:00',strtotime($item['updated_at'])) }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach
  @foreach($news as $item)
    <url>
      <loc>{{request()->root()}}/{{$item['lang']}}/news/{{$item['id']}}.html</loc>
      <lastmod>{{date('Y-m-d\Th:i:s+08:00',strtotime($item['updated_at'])) }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.9</priority>
    </url>
  @endforeach
  @foreach($pages as $item)
    <url>
      <loc>{{request()->root()}}/{{$item['lang']}}/page/{{$item['alias']}}</loc>
      <lastmod>{{date('Y-m-d\Th:i:s+08:00',strtotime($item['updated_at'])) }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.8</priority>
    </url>
  @endforeach

</urlset>
