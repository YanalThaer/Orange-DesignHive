<div class="col-lg-3 sidebar">
    <div class="widgets-container" data-aos="fade-up" data-aos-delay="200">
        <div class="categories-widget widget-item">
            <h3 class="widget-title">Categories</h3>
            <ul class="mt-3">
                <li>
                    <a href="{{ route('category.posts', 0) }}"
                        class="{{ (isset($currentCategoryId) && $currentCategoryId == 0) ? 'active' : '' }}">
                        All <span>({{ $totalProjects ?? 0 }})</span>
                    </a>
                </li>
                @if ($categories->isEmpty())
                <p>No categories available</p>
                @else
                @foreach($categories as $category)
                @php
                $categoryname = $category->name;
                if (empty($categoryname)) {
                $categoryname = 'No Category Name';
                } else {
                $categoryname = $category->name;
                }
                @endphp
                <li>
                    <a href="{{ route('category.posts', $category->id) }}"
                        class="{{ (isset($currentCategoryId) && $currentCategoryId == $category->id) ? 'active' : '' }}">
                        {{ $categoryname }} <span>({{ $category->projects_count ?? 0 }})</span>
                    </a>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
        <div class="tags-widget widget-item">
            <h3 class="widget-title">Tags</h3>
            <ul>
                @if ($tags->isEmpty())
                <p>No tags available</p>
                @else
                @foreach($tags as $tag)
                @php
                $tagname = $tag->name;
                if (empty($tagname)) {
                $tagname = 'No Tag';
                } else {
                $tagname = $tag->name;
                }
                @endphp
                <li><a href="{{ route('projects.byTag', $tag->id) }}">#{{ $tagname }}</a></li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>