<?php $page = "Games" ?>
<?php include "includes/config.php"; ?>
<?php

$per_page = 20;


$total_game = mysqli_num_rows(mysqli_query($con, "select * from zon_games"));
$total = $total_game / $per_page;
$total = intval($total);

if (isset($_GET) && isset($_GET['page'])) {
    $page_no = $_GET['page'];
    $cal = ($page_no - 0) * $per_page;

    $sql = "select * from zon_games order by id desc limit $cal, $per_page";
} else {
    $page_no = 0;
    $sql = "select * from zon_games order by id desc limit 10";
}


$run = mysqli_query($con, $sql);
?>

<?php require "../includes/function_general.php"; ?>
<?php include "includes/header.php"; ?>

<body class="dark:bg-[#121317]">
    <main class="d-flex ">
        <?php include "includes/sidebar.php"; ?>
        <div class="main w-full px-12 py-6">
            <div class="games-list">
                <div class="header flex gap-6">
                    <a href="add-game.php" class="py-2 px-6 bg-blue-400 text-white uppercase text-xs rounded-md">ADD</a>

                </div>
                <table class="w-full mt-10  ">
                    <thead class="border-b-2 dark:border-zinc-900 px-16 border-gray-100 py-2">
                        <td class="py-2 text-xs text-gray-600 px-4">ID</td>
                        <td class="py-2 text-xs text-gray-600 px-4 w-full">Name</td>
                        <td class="py-2 text-xs text-right"></td>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($run)) { ?>
                            <?php if ($row['game_status'] == 0) { ?>
                                <tr class="bg-[white] dark:bg-zinc-900 px-16 ">
                                    <td class="text-xs text-gray-500 px-4 ">#<?= $row['id'] ?></td>
                                    <td class="text-gray-500 px-4 text-sm flex items-center py-3"><img class="object-cover h-12 w-12 rounded-lg mr-4 overflow-hidden" src="<?= $row['game_image_url'] ?>"> <a href="add-game.php?action=update&token_id=<?= $row['id'] ?>"><?= $row['game_name'] ?></a></td>
                                    <td class="text-right relative px-6">
                                        <button data-target="#dc_<?= $row['id'] ?>" class="bi-three-dots-vertical text-gray-500 drop_btn"></button>
                                        <div id="dc_<?= $row['id'] ?>" style="z-index: 99;" class="dropdown absolute bg-white text-right right-0 hidden flex-column ">
                                            <a href="functions/functions.php?action=delete&token_id=<?= $row['id'] ?>&content_type=game" class="text-xs px-4 py-2 text-red-700">Delete</a>
                                            <a href="add-game.php?action=update&token_id=<?= $row['id'] ?>&content_type=game" class="text-xs px-4 py-2">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="flex justify-center ">
                    <div class="flex gap-2 mt-6 mb-12 w-96 scroll-hidden">
                        <?php
                        if ($page_no >= 1) { ?>
                            <a href="?page=<?php echo $page_no - 1 ?>" class="px-3 hover:text-black dark:bg-zinc-900 dark:text-gray-200 dark:hover:text-white text-gray-800 py-2 bg-gray-200 uppercase rounded-lg">prev</a>
                        <?php  } ?>
                        <?php if ($page_no !== $total) { ?>
                            <a href="?page=<?php echo $page_no ?>" class="px-3 hover:text-black dark:text-gray-200 dark:hover:text-white text-gray-200 py-2 bg-blue-600 uppercase rounded-lg"><?php echo $page_no ?></a>
                            <a href="?page=<?php echo $page_no + 1 ?>" class="px-3 hover:text-black dark:text-gray-200 dark:hover:text-white text-gray-200 py-2 bg-blue-600 uppercase rounded-lg"><?php echo $page_no + 1 ?></a>
                            <a href="?page=<?php echo $page_no + 2 ?>" class="px-3 hover:text-black dark:text-gray-200 dark:hover:text-white text-gray-200 py-2 bg-blue-600 uppercase rounded-lg"><?php echo $page_no + 2 ?></a>
                            <a href="?page=<?php echo $page_no + 3 ?>" class="px-3 hover:text-black dark:text-gray-200 dark:hover:text-white text-gray-200 py-2 bg-blue-600 uppercase rounded-lg"><?php echo $page_no + 3 ?></a>
                        <?php } else { ?>
                            <a href="?page=0" class="px-3 hover:text-black dark:text-gray-200 dark:hover:text-white text-gray-800 py-2 bg-blue-600 uppercase rounded-lg">0</a>
                        <?php }?>
                        <?php
                        // if ($page_no >= 1) { 
                        ?>
                        <a href="?page=<?php echo $page_no + 1 ?>" class="px-3 hover:text-black dark:bg-zinc-900  dark:text-gray-200 dark:hover:text-white text-gray-800 py-2 bg-gray-200 uppercase rounded-lg">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "includes/footer.php"; ?>
</body>

</html>