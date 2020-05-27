<div class="ps-shopping__actions">
    <select class="ps-select" data-placeholder="Sort Items" onchange="window.location.href=this.value">
        <option value="{{ route('front.product') }}">Sort by latest</option>
        <option value="{{ route('front.product.atoz') }}">Sort by Name: A - Z</option>
        <option value="{{ route('front.product.ztoa') }}">Sort by Name: Z - A</option>
    </select>
    <div class="ps-shopping__view">
        <p>View</p>
        <ul class="ps-tab-list">
            <li class="active"><a href="#tab-1"><i class="icon-grid"></i></a></li>
            <li><a href="#tab-2"><i class="icon-list4"></i></a></li>
        </ul>
    </div>
</div>