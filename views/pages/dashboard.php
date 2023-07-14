
<section class="body_section w-screen min-h-screen" style="padding:3rem 2.5rem 3rem;">
    <span class="w-full text-center shadow-xl"><h1 class="font-bold text-2xl text-gray-50 mb-10">Your Journal Entries</h1></span>
    <div class="rounded-md w-full min-h-screen bg-white  p-10">
        <div class="w-full block flex ml-auto mb-5">
            <button class="btn btn-accent ml-auto text-white add_journal_btn">
                Add a Journal Entry
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

            </button>
        </div>
        <!--        journal template-->
        <div class="journal_entry card bg-base-100 shadow-xl image-full h-80" style="display:none">
            <figure><img src="<?= ROOT?>resources/images/stocks/journal_1.jpg" alt="Shoes" /></figure>
            <div class="card-body" >
                <h2 class="card-title break-all"></h2>
                <small class="float-right published_date"></small>
                <p class="description break-all hidden md:block"></p>
                <p class="description_mobile break-all md:hidden"></p>
                <div class="card-actions justify-end">
                    <button class="btn btn-sm btn-neutral see_more_btn" id="">See More</button>
                    <button class="btn btn-sm bg-red-400 text-white delete_journal_btn border-red-400 hover:bg-red-500 hover:border-red-500"   id="">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!--        empty list template-->
        <div class="empty_list w-full h-80 block flex justify-center items-center mb-5 col-span-3" style="display:none">
            <h1 class="font-bold text-xl">You are yet to share your thoughts! Add your first entry!</h1>
        </div>

<!--        ENTRIES SECTION-->
        <div class="grid md:grid-cols-3 grid-cols-1 block gap-x-4 md:gap-y-4 gap-y-24 entries_list ">
            <?php if(count((array)$data->journals)){?>
                <?php foreach ($data->journals as $journal){
                    $journal_body = json_decode($journal->journal_details);

                    ?>
                    <div class="journal_entry card bg-base-100 shadow-xl image-full h-80" id="journal_<?=$journal->id?>">
                        <figure><img src="<?= ROOT?>resources/images/stocks/journal_1.jpg" alt="Shoes" /></figure>
                        <div class="card-body" >
                            <h2 class="card-title break-all"><?=(strlen($journal_body->journal_title)>35?substr($journal_body->journal_title,0,35).'....':$journal_body->journal_title);?></h2>
                            <small class="float-right published_date"><?=date('d M y, H:i', strtotime($journal->published_date)).' ('.getTimeDifference($journal->published_date).')'?></small>
                            <p class="description break-all hidden md:block"><?=(strlen($journal_body->journal_body)>70?substr($journal_body->journal_body,0,70).'....':$journal_body->journal_body);?></p>
                            <p class="description_mobile break-all md:hidden"><?=(strlen($journal_body->journal_body)>40?substr($journal_body->journal_body,0,40).'....':$journal_body->journal_body);?></p>
                            <div class="card-actions justify-end">
                                <button class="btn btn-sm btn-neutral see_more_btn" id="<?=$journal->id?>">See More</button>
                                <button class="btn btn-sm bg-red-400 text-white delete_journal_btn border-red-400 hover:bg-red-500 hover:border-red-500"   id="<?=$journal->id?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <div class="empty_list w-full h-80 block flex justify-center items-center mb-5 col-span-3" >
                    <h1 class="font-bold text-xl">You are yet to share your thoughts! Add your first entry!</h1>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

