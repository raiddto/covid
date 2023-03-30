<th scope="col"></th>
<th scope="col">Name</th>
<th scope="col">Gender</th>
<th scope="col">Age</th>
<th scope="col">Mobile No.</th>
<th scope="col">Body Temp</th>
<th scope="col">Diagnosed</th>
<th scope="col">Encountered</th>
<th scope="col">Vacinated</th>
<th scope="col">Nationality</th>
<th scope="col">Action</th>

profileid
firstname
lastname
gender
age
mobile
temp
diag
enc
vax
nat

select sum(if((`personprofile`.`enc` = 'Y'),1,0)) AS `totalenc`,sum(if((`personprofile`.`vax` = 'Y'),1,0)) AS `totalvax`,sum(if((`personprofile`.`temp` >= 37),1,0)) AS `totalfever`,sum(if((`personprofile`.`age` >= 18),1,0)) AS `totaladult`,sum(if((`personprofile`.`age` <= 17),1,0)) AS `totalminor`,sum(if(((`personprofile`.`nat` <> 'filipino') or (`personprofile`.`nat` <> 'Filipino')),1,0)) AS `totalforeign` from `personprofile`