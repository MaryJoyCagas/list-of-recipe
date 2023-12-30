<?php
include 'header.php';
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    ob_end_flush();
}
?>

<div class="container-fluid d-flex justify-content-center">
    <div class="tab-content d-flex my-5 justify-content-center align-items-center" id="v-pills-tabContent" style="height: 300px;">

        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
            <div class="px-2 position-relative" style="font-size: .8rem;">

                <table class="table">
                    <thead align="center">
                        <tr>
                            <th scope="col" class="px-md-4">#</th>
                            <th scope="col" class="text-start px-md-4">Dish</th>
                            <th scope="col" class="px-md-4">Recipe</th>
                            <th scope="col" class="px-md-4">Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">

                        <tr>
                            <?php
                            $userID = $_SESSION['u_id'];
                            $cnt = 1;
                            $select = $conn->prepare("SELECT * FROM list WHERE userID = ?");
                            $select->execute([$userID]);
                            foreach ($select as $selects) { ?>

                                <th class="px-md-4" scope="row"><?= $cnt++ ?></th>
                                <td class="px-md-4" align="start"><?= $selects['p_Dish'] ?></td>
                                <td class="px-md-4">
                                    <div class="dropdown">
                                        <a class="text-decoration-none dropdown-toggle text-black" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                        <ul class="dropdown-menu text-center">
                                            <table class="table" style="font-size: .7rem;">
                                                <thead align="center">
                                                    <tr>
                                                        <th scope="col" class="px-md-2">Item</th>
                                                        <th scope="col" class="px-md-2">Price</th>
                                                        <th scope="col" class="px-md-2">Quantity</th>
                                                        <th scope="col" class="px-md-2">Total</th>
                                                        <th scope="col" class="px-md-2">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody align="center">

                                                    
                                                        <?php
                                                        $listID = $selects['p_id'];
                                                        $getID = $conn->prepare("SELECT * FROM recipes WHERE list_id = ?");
                                                        $getID->execute([$listID]);
                                                        foreach ($getID as $data) { ?>
                                                        <tr>
                                                            <td class="px-md-2"><?= $data['p_recipe'] ?></td>
                                                            <td class="px-md-2">₱ <?= $data['p_price'] ?></td>
                                                            <td class="px-md-2"><?= $data['p_quantity'] ?></td>
                                                            <td class="px-md-2">₱ <?= $data['p_price'] * $data['p_quantity'] ?> </td>
                                                            <td class="px-md-2">
                                                                <a class="dropdown-item px-1 " href="new.php?update&id=<?= $data['p_id'] ?>" class="text-decoration-none">✏</a>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                </tbody>
                                            </table>
                                        </ul>
                                    </div>
                                </td>

                                <td class="px-md-1">
                                        <a class="text-decoration-none px-1" href="addone.php?get&id=<?= $selects['p_id'] ?>" class="text-decoration-none">➕</a>
                                        |
                                        <a class="text-decoration-none px-1 " href="backend.php?delete&id=<?= $selects['p_id'] ?>" class="text-decoration-none">❌</a>
                                </td>

                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>