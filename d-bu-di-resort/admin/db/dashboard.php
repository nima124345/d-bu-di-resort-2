<?php
include './connect.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'GET' && !isset($_GET['id'])) {
    global $con;
    $res = mysqli_query($con, "select sum(waitOrder) waitOrder,sum(orderToday) orderToday,sum(sumPricrToday) sumPricrToday
    ,sum(sumPricrMonth) sumPricrMonth
   from
   (select count(*) as waitOrder,0 orderToday,0 as sumPricrToday,0 as sumPricrMonth
   from order_head
   where o_status='กำลังตรวจสอบ'
   union all
   select 0 waitOrder,count(*) as orderToday,od.sum_price as sumPricrToday,0 as sumPricrMonth
   from order_head
   left join (
   select SUM(`order_detail`.d_subtotal) sum_price,o_id from `order_detail` group by o_id ) od on od.o_id=order_head.o_id
   where cast(o_date as date)= cast(now() as date)
   union all
   select 0 waitOrder,0 orderToday,0 as sumPricrToday,count(*) as sumPricrMonth
   from tbl_Member
   ) AS a
    
    ");
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $namesArray[] = array(
            'waitOrder' => $row['waitOrder'],
            'orderToday' => $row['orderToday'],
            'sumPricrToday' => $row['sumPricrToday'],
            'sumPricrMonth' => $row['sumPricrMonth']
        );
    }
    $data = $namesArray;
    echo json_encode($data);
    mysqli_close($con);
}
