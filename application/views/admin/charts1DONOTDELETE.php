<?php
$this->db->where('status !=', 'Closed');
$this->db->where('status !=', 'Deleted');
$open_tickets = $this->db->get('tickets');
$open_tickets1 = $open_tickets->result();

$jan = $feb = $mar = $apr = $may = $jun = $jul = $aug = $sep = $oct = $nov = $dec = 0;

foreach ($open_tickets1 as $key) {
    $date = $key->created_on;
    //echo $date."</br>";
    $month = date("F", strtotime($date));
    if ($month == 'January') {
        $jan = $jan + 1;
    } else if ($month == 'February') {
        $feb = $feb + 1;
    } else if ($month == 'March') {
        $mar = $mar + 1;
    } else if ($month == 'April') {
        $apr = $apr + 1;
    } else if ($month == 'May') {
        $may = $may + 1;
    } else if ($month == 'June') {
        $jun = $jun + 1;
    } else if ($month == 'July') {
        $jul = $jul + 1;
    } else if ($month == 'August') {
        $aug = $aug + 1;
    } else if ($month == 'September') {
        $sep = $sep + 1;
    } else if ($month == 'October') {
        $oct = $oct + 1;
    } else if ($month == 'November') {
        $nov = $nov + 1;
    } else if ($month == 'December') {
        $dec = $dec + 1;
    }
}

$jan1 = $feb1 = $mar1 = $apr1 = $may1 = $jun1 = $jul1 = $aug1 = $sep1 = $oct1 = $nov1 = $dec1 = 0;
$this->db->where('status =', 'Closed');
$closed_tickets = $this->db->get('tickets');
$closed_tickets1 = $closed_tickets->result();
foreach ($closed_tickets1 as $key1) {
    $date = $key1->created_on;
    //echo $date."</br>";
    $month = date("F", strtotime($date));
    if ($month == 'January') {
        $jan1 = $jan1 + 1;
    } else if ($month == 'February') {
        $feb1 = $feb1 + 1;
    } else if ($month == 'March') {
        $mar1 = $mar1 + 1;
    } else if ($month == 'April') {
        $apr1 = $apr1 + 1;
    } else if ($month == 'May') {
        $may1 = $may1 + 1;
    } else if ($month == 'June') {
        $jun1 = $jun1 + 1;
    } else if ($month == 'July') {
        $jul1 = $jul1 + 1;
    } else if ($month == 'August') {
        $aug1 = $aug1 + 1;
    } else if ($month == 'September') {
        $sep1 = $sep1 + 1;
    } else if ($month == 'October') {
        $oct1 = $oct1 + 1;
    } else if ($month == 'November') {
        $nov1 = $nov1 + 1;
    } else if ($month == 'December') {
        $dec1 = $dec1 + 1;
    }
}
?>
<script type="text/javascript">
    $(document).ready(function () {

        var jan =<?php echo $jan;?>;
        var feb =<?php echo $feb;?>;
        var mar =<?php echo $mar;?>;
        var apr =<?php echo $apr;?>;
        var may =<?php echo $may;?>;
        var jun =<?php echo $jun;?>;
        var jul =<?php echo $jul;?>;
        var aug =<?php echo $aug;?>;
        var sep =<?php echo $sep;?>;
        var oct =<?php echo $oct;?>;
        var nov =<?php echo $nov;?>;
        var dec =<?php echo $dec;?>;

        var jan1 =<?php echo $jan1;?>;
        var feb1 =<?php echo $feb1;?>;
        var mar1 =<?php echo $mar1;?>;
        var apr1 =<?php echo $apr1;?>;
        var may1 =<?php echo $may1;?>;
        var jun1 =<?php echo $jun1;?>;
        var jul1 =<?php echo $jul1;?>;
        var aug1 =<?php echo $aug1;?>;
        var sep1 =<?php echo $sep1;?>;
        var oct1 =<?php echo $oct1;?>;
        var nov1 =<?php echo $nov1;?>;
        var dec1 =<?php echo $dec1;?>;
        var d1, d2, data, chartOptions

        var open_tickets_lbl = "<?php echo $this->lang->line('open_tickets');?>"
        var closed_tickets_lbl = "<?php echo $this->lang->line('closed_tickets');?>"
        var jan_lbl = "<?php echo $this->lang->line('jan');?>"
        var feb_lbl = "<?php echo $this->lang->line('feb');?>"
        var mar_lbl = "<?php echo $this->lang->line('mar');?>"
        var apr_lbl = "<?php echo $this->lang->line('apr');?>"
        var may_lbl = "<?php echo $this->lang->line('may');?>"
        var jun_lbl = "<?php echo $this->lang->line('jun');?>"
        var jul_lbl = "<?php echo $this->lang->line('jul');?>"
        var aug_lbl = "<?php echo $this->lang->line('aug');?>"
        var sep_lbl = "<?php echo $this->lang->line('sep');?>"
        var oct_lbl = "<?php echo $this->lang->line('oct');?>"
        var nov_lbl = "<?php echo $this->lang->line('nov');?>"
        var dec_lbl = "<?php echo $this->lang->line('dec');?>"


        c3.generate({
            bindto: '#line1',
            size: {
                height: 300
            },
            data: {
                columns: [
                    [open_tickets_lbl, jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec],
                    [closed_tickets_lbl, jan1, feb1, mar1, apr1, may1, jun1, jul1, aug1, sep1, oct1, nov1, dec1]
                ],
                types: {
                    OpenTickets: 'area-spline',
                    ClosedTickets: 'area-spline'
                    // 'line', 'spline', 'step', 'area', 'area-step' are also available to stack
                },
                colors: {
                    OpenTickets: '#39c7aa',
                    ClosedTickets: '#efa6ad'
                }
            }, axis: {
                x: {
                    type: 'category',
                    categories: [jan_lbl, feb_lbl, mar_lbl, apr_lbl, may_lbl, jun_lbl, jul_lbl, aug_lbl, sep_lbl, oct_lbl, nov_lbl, dec_lbl]
                }
            }
        });
    });

    <?php
    $this->db->where('service =', 'Halll');
    $hall = $this->db->count_all_results('tickets');
    $this->db->where('service =', 'Bathroom');
    $bathroom = $this->db->count_all_results('tickets');
    $this->db->where('service =', 'Apartment');
    $apartment = $this->db->count_all_results('tickets');
    $this->db->where('service =', 'Kitchen');
    $kitchen = $this->db->count_all_results('tickets');
    $this->db->where('service =', 'Bedroom');
    $bedroom = $this->db->count_all_results('tickets');
    $this->db->where('service =', 'Living room');
    $livingroom = $this->db->count_all_results('tickets');
    $this->db->where('service =', 'Other');
    $other = $this->db->count_all_results('tickets');
    ?>
    $(function () {
        var hall = <?php echo $hall; ?>;
        var bathroom = <?php echo $bathroom; ?>;
        var apartment = <?php echo $apartment; ?>;
        var kitchen = <?php echo $kitchen; ?>;
        var bedroom = <?php echo $bedroom; ?>;
        var livingroom = <?php echo $livingroom; ?>;
        var other = <?php echo $other; ?>;


        c3.generate({
            bindto: '#donut',
            size: {
                height: 300
            },
            data: {
                columns: [
                    ['Hall', hall],
                    ['Bathroom', bathroom],
                    ['Apartment', apartment],
                    ['Kitchen', kitchen],
                    ['Bedroom', bedroom],
                    ['Livingroom', livingroom],
                    ['Other', other],
                ],
                type: 'donut',
                onclick: function (d, i) {
                    console.log("onclick", d, i);
                },
                onmouseover: function (d, i) {
                    console.log("onmouseover", d, i);
                },
                onmouseout: function (d, i) {
                    console.log("onmouseout", d, i);
                }
            },
            color: {
                pattern: ['#39c7aa', '#cce7e2', '#fd9421', '#fdd3a6', '#ed5565', '#efa6ad', '#48a8e4']
            }
        });


    });

    $(function () {
        var amt_billed = 10;
        var discount = 200;
        var rot = 500;
        var tax = 100;

        c3.generate({
            bindto: '#donut2',
            size: {
                height: 232
            },
            data: {
                columns: [
                    ['Amount Billed', amt_billed],
                    ['Discount', discount],
                    ['ROT', rot],
                    ['Tax', tax],
                ],
                type: 'donut',
                onclick: function (d, i) {
                    console.log("onclick", d, i);
                },
                onmouseover: function (d, i) {
                    console.log("onmouseover", d, i);
                },
                onmouseout: function (d, i) {
                    console.log("onmouseout", d, i);
                }
            },
            color: {
                pattern: ['#fdd3a6', '#efa6ad', '#39c7aa', '#cce7e2']
            },
            donut: {
                label: {
                    format: function (value) {
                        return value;
                    }
                }
            }
        });


    });
</script>
