<?php
/**
 * Draw a Product List
 */

$page_link = function($q, $i) {
	return sprintf('<a class="btn btn-outline-secondary" href="/search?q=%s&amp;p=%d">%d</a>', $q, $i, $i);
};

?>

<h1>Product List</h1>

<form>
<div class="input-group mb-4">
	<input class="form-control" name="q" placeholder="Search.." value="<?= __h($data['search_page']['q']) ?>">
	<div class="input-group-append">
		<button class="btn btn-outline-success"><i class="fa fa-search"></i> Search</button>
	</div>
</div>
</form>

<div>
<div class="btn-group">
	<a class="btn btn-outline-secondary disabled" style="width:6em;">Index:</a>
	<?php
	foreach ($data['search_pick'] as $k => $v) {
		printf('<a class="btn btn-outline-secondary" href="/search?q=%s" title="Products starting with %s (%s)">%s</a>',
			urlencode($k),
			$k,
			$v,
			$k);
	}
	?>
</div>
</div>

<div>
<div class="btn-group">
	<a class="btn btn-outline-secondary disabled" style="width:6em;">Pages:</a>
	<?php
	if ($data['search_page']['max'] > 18) {
	?>

		<a class="btn btn-outline-secondary" href="/search?q=<?= urlencode($data['search_page']['q']) ?>&amp;p=<?= max(1, $data['search_page']['cur'] - 1) ?>"><i class="fa fa-arrow-left"></i></a>

		<?php
		for ($idx=1; $idx<3; $idx++) {
			echo $page_link($data['search_page']['q'], $idx);
		}
		?>

		<!--
		{% for i in 1..search_page.max %}
			<a class="btn btn-outline-secondary" href="/search?q={{ search_page.q }}&amp;p={{ loop.index }}">p{{ loop.index }}</a>
		{% endfor %}
		-->

		<?php
		$min = max(4, $data['search_page']['cur'] - 6);
		$max = min($min + 12, $data['search_page']['max']);
		for ($idx=$min; $idx<$max; $idx++) {
			echo $page_link($data['search_page']['q'], $idx);
		}

		$min = $max;
		$max = $data['search_page']['max'];
		for ($idx=$min; $idx<$max; $idx++) {
			echo $page_link($data['search_page']['q'], $idx);
		}
		?>

		<a class="btn btn-outline-secondary" href="/search?q=<?= urlencode($data['search_page']['q']) ?>&amp;p=<?= $data['search_page']['cur'] + 1 ?>"><i class="fa fa-arrow-right"></i></a>

	<?php
	} else {
		for ($idx=1; $idx < $data['search_page']['max']; $idx++) {
			echo $page_link($data['search_page']['q'], $idx);
		}
	}
	?>
</div>
</div>


<div class="table-responsive mt-4">
<table class="table table-sm table-hover">
<thead>
<tr>
	<th>Product</th>
	<th>Type</th>
	<th>Validity</th>
	<th>Stub</th>
</tr>
</thead>
<tbody>
<?php
foreach ($data['search_data'] as $product) {
?>
	<tr>
		<td><a href="/product/<?= $product['id'] ?>"><?= __h($product['name']) ?></a></td>
		<td><?= __h($product['type']) ?></td>
		<td><?= __h($product['vote']) ?></td>
		<td><?= __h($product['stub']) ?></td>
	</tr>
<?php
}
?>
</tbody>
</table>
</div>
