
<div class="btn-group" role="group" aria-label="Basic example">


  <?php


  if($page_number>=2){
echo "<a href='index.php?page=".($page_number-1)."'>  Prev </a>";
}
for ($i=1; $i<=$total_pages; $i++) {
if ($i == $page_number) {
$pageURL .= "<a class = 'active' href='index.php?page="
.$i."'>".$i." </a>";
}
else  {
$pageURL .= "<a href='index.php?page=".$i."'>
".$i." </a>";
}
};
echo $pageURL;
if($page_number<$total_pages){
echo "<a href='index.php?page=".($page_number+1)."'>  Next </a>";
}



   ?>



  <?php
    if($this->total_no_of_pages > 5) {
      $total_no_of_pages = 6;
    } else {
      $total_no_of_pages = $this->total_no_of_pages;
    }

    if($this->page_no )

   ?>
  <?php for($i = 1; $i <= $total_no_of_pages; $i++): ?>
    <?php if($i == $this->page_no): ?>
      <a type="button" class="btn btn-outline-secondary active" href="<?=BASE_URL;?>/dean/new?page_no=<?=$i;?>"><?=$i;?></a>
    <?php else: ?>
      <a type="button" class="btn btn-outline-secondary" href="<?=BASE_URL;?>/dean/new?page_no=<?=$i;?>"><?=$i;?></a>
    <?php endif;?>
  <?php endfor; ?>
</div>

<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $this->page_no." of ".$this->total_no_of_pages; ?></strong>
</div>
