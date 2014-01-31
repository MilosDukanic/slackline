<?php

class AjaxController extends Zend_Controller_Action
{

    public function init()
    {
        $request=  $this->getRequest();
        if(!$request->isPost()){
            $this->_helper->redirector('index', 'index');
        }
        $autentification= Zend_Auth::getInstance();
        $menu= new Application_Model_MenuMapper();
        if(!$autentification->hasIdentity()){
            $this->_helper->redirector('index', 'index');
        }
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
        $table=$_POST['table'];
        $id=$_POST['id'];
        
        $users= new Application_Model_User();
        $usersMapper= new Application_Model_UserMapper();
        $users= $usersMapper->fetchAll('true');
        
        $tricks= new Application_Model_Trick();
        $tricksMapper= new Application_Model_TrickMapper();
        $tricks= $tricksMapper->fetchAll('true');
        
        $role= new Application_Model_Roles();
        $roleMapper= new Application_Model_RolesMapper();
        $role=$roleMapper->fetchAll('true');

        $trickType= new Application_Model_Tricktype();
        $trickTypeMapper= new Application_Model_TricktypeMapper();
        $trickType= $trickTypeMapper->fetchAll('true');

        $trickMark= new Application_Model_Trickweightmark();
        $trickMarkMapper= new Application_Model_TrickweightmarkMapper();
        $trickMark= $trickMarkMapper->fetchAll('true');
        
        $weight= new Application_Model_Trickweight();
        $weightMapper= new Application_Model_TrickweightMapper();
        $weight=$weightMapper->fetchAll('true');
        
        $brand= new Application_Model_Brand();
        $brandMapper= new Application_Model_BrandMapper();
        $brand= $brandMapper->fetchAll('true');
        
        $rating= new Application_Model_Slacklinerating();
        $ratingMapper= new Application_Model_SlacklineratingMapper();
        $rating= $ratingMapper->fetchAll('true');
            
        $setupType= new Application_Model_Typesetup();
        $setupTypeMapper= new Application_Model_TypesetupMapper();
        $setupType= $setupTypeMapper->fetchAll('true');
        
        $gears= new Application_Model_Gear();
        $gearsMapper= new Application_Model_GearMapper();
        $gears= $gearsMapper->fetchAll('true');
        
        $slacklines= new Application_Model_Slackline();
        $slacklinesMapper= new Application_Model_SlacklineMapper();
        $slacklines= $slacklinesMapper->fetchAll();
        
        if($table=='menu'){
            if($id==0){
                echo "<tr>
                    <td><input type='text' placeholder='Menu text' id='menuText'/></td>
                    </tr>
                    <tr>
                        <td><input type='text' placeholder='Menu controler' id='menuController'/></td>
                    </tr>
                    <tr>
                        <td><input type='text' placeholder='Menu action' id='menuAction'/></td>
                    </tr>
                    <td>
                        <select id='menuRola'>
                            <option value='0'>Everyone can see...</option>
                        ";
                            foreach ($role as $val) {
                                echo "<option value='".$val->getId()."'>".$val->getName()."</option>";
                            }
                    echo "</select>
                        </td>
                    </tr>
                    <tr><td><input type='text' placeholder='Menu position' id='menuPosition'/></td></tr>";
            }
            else{
                $menu= new Application_Model_Menu();
                $menuMapper= new Application_Model_MenuMapper();
                $menu= $menuMapper->fetchOneAdmin($id);
                foreach ($menu as $value) {
                    echo "<tr>
                        <td><input type='text' placeholder='Menu text' id='menuText' value='".$value->getText()."'/></td>
                        </tr>
                        <tr>
                            <td><input type='text' placeholder='Menu controler' id='menuController' value='".$value->getHref()."'/></td>
                        </tr>
                        <tr>
                            <td><input type='text' placeholder='Menu action' id='menuAction' value='".$value->getAction()."'/></td>
                        </tr>
                        <tr>
                        <td>
                            <select id='menuRola'>
                                <option value='0'>Everyone can see...</option>
                        ";
                                foreach ($role as $val) {
                                    echo "<option value='".$val->getId()."'";
                                    if($val->getId() == $value->getRole()) {
                                        echo " selected";
                                    }
                                    echo " >".$val->getName()."</option>";
                                }
                        echo "</select>
                            </td>
                        </tr>
                        <tr><td><input type='text' placeholder='Menu position' id='menuPosition' value='".$value->getPosition()."'/></td></tr>.";
                }
            }
        }
        if($table=='trickType'){
            if($id==0){
                echo "
                    <tr>
                        <td><input type='text' placeholder='Trick type name'  name='trickTypeName' id='trickTypeName'/></td>
                    </tr>
                     <tr>
                        <td>
                            <span>Trick type image </span> <input type='file' name='trickTypeImage' id='trickTypeImg' required/>
                        </td>
                    </tr>";
            }
            else{
                $type=new Application_Model_Tricktype();
                $typeMapper= new Application_Model_TricktypeMapper();
                $type=$typeMapper->fetchOne($id);
                foreach ($type as $value) {
                    echo "
                        <tr>
                            <td><input type='text' placeholder='Trick type name' name='trickTypeName' id='trick' value='".$value->getName()."'/></td>
                        </tr>
                         <tr>
                            <td>
                                <span>Trick type image </span> <input type='file' name='trickTypeImage'/>
                            </td>
                        </tr>";
                }
            }
        }
        if($table=='trickWeight'){
             if($id==0){
                 echo "<tr>
                        <td><input type='text' placeholder='Trick weight name' id='trickWeightName'/></td>
                    </tr>";
             }
             else{
                 $weight= new Application_Model_Trickweight();
                 $weightMapper= new Application_Model_TrickweightMapper();
                 $weight= $weightMapper->fetchOne($id);
                 foreach ($weight as $value) {
                     echo "<tr>
                        <td><input type='text' placeholder='Trick weight name' id='trickWeightName' value='".$value->getName()."'/></td>
                    </tr>";
                 }
                 
             }
        }
        if($table=='trick'){
            if($id==0){
                echo "<tr>
                <td>
                    <select name='trickType'>
                        <option value='0'>Choose type...</option>";
                            foreach ($trickType as $value) {
                                echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                            }
                    echo "</select>
                </td>
            </tr>
            <tr>
                <td>
                    <select name='trickMark'>
                        <option value='0'>Choose mark...</option>";
                            foreach ($trickMark as $value) {
                                echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                            }
                echo "</select>
                    </td>
                </tr>
                <tr>
                    <td><input type='text' placeholder='Trick name' name='trickName'/></td>
                </tr>
                <tr>
                    <td><textarea placeholder='Trick description' name='trickDescription'></textarea></td>
                </tr>
                <tr><td><input type='text' placeholder='Trick video' name='trickVideo'/></td></tr>
                 <tr>
                    <td>
                        <span>Trick image </span> <input type='file' name='trickImage' required/>
                    </td>
                </tr>";
            }
            else {
                $trick= new Application_Model_Trick();
                $trickMapper= new Application_Model_TrickMapper();
                $trick=$trickMapper->fetchOne($id);
                foreach ($trick as $val) {
                    echo "<tr>
                            <td>
                                <select name='trickType'>
                                    <option value='0'>Choose type...</option>";
                                        foreach ($trickType as $value) {
                                            echo "<option value='".$value->getId()."'";
                                                if($value->getName() == $val->getIdType()){
                                                    echo ' selected';
                                                }
                                            echo ">".$value->getName()."</option>";
                                        }
                                echo "</select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name='trickMark'>
                                    <option value='0'>Choose mark...</option>";
                                        foreach ($trickMark as $value) {
                                            echo "<option value='".$value->getId()."'";
                                                if($val->getIdMark() == $value->getName()){
                                                    echo ' selected';
                                                }
                                            echo ">".$value->getName()."</option>";
                                        }
                    echo "</select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type='text' placeholder='Trick name' name='trickName' value='".$val->getName()."'/></td>
                    </tr>
                    <tr>
                        <td><textarea placeholder='Trick description' name='trickDescription'>".$val->getDescription()."</textarea></td>
                    </tr>
                    <tr><td><input type='text' placeholder='Trick video' name='trickVideo' value='".$val->getVideo()."'/></td></tr>
                     <tr>
                        <td>
                            <span>Trick image </span> <input type='file' name='trickImage'/>
                        </td>
                    </tr>";
                }
                
            }
        }
        if($table=='trickWeightMark'){

            if($id==0){
                 echo "<tr>
                        <td>
                            <select name='type' id='trickWeightMarkType'>
                                <option value='0'>Choose Weight...</option>";
                                    foreach ($weight as $value) {
                                        echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                                    }

                            echo "</select>
                            </td>
                    </tr>
                    <tr>
                        <td><input type='text' placeholder='Trick weight mark name' id='trickWeightMarkName'/></td>
                    </tr>";
             }
             else{
                $mark= new Application_Model_Trickweightmark();
                $markMapper= new Application_Model_TrickweightmarkMapper();
                $mark=$markMapper->fetchOne($id);
                foreach ($mark as $value) {        
                 echo "<tr>
                        <td>
                            <select name='type' id='trickWeightMarkType'>
                                <option value='0'>Choose Weight...</option>";
                                    foreach ($weight as $val) {
                                        echo "<option value='".$val->getId()."' ";
                                        if($val->getId()== $value->getIdWeight()){
                                            echo "selected";
                                        }
                                        echo ">".$val->getName()."</option>";
                                    }

                            echo "</select>
                            </td>
                    </tr>
                    <tr>
                        <td><input type='text' placeholder='Trick weight mark name' id='trickWeightMarkName' value='".$value->getName()."'/></td>
                    </tr>";
                } 
            }
        }
        if($table=='gear'){
            if($id==0){
                 echo "
                    <tr>
                        <td><input type='text' placeholder='Slackline kit name' name='name'/></td>
                    </tr>
                    <tr>
                        <td><textarea placeholder='Slackline kit description' name='description'></textarea></td>
                    </tr>
                    <tr>
                        <td><textarea placeholder='Slackline kit specification' name='specification'></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <span>Kit image </span> <input type='file' name='image' required/>
                        </td>
                    </tr>";
             }
             else{
                 $gear= new Application_Model_Gear();
                 $gearMapper= new Application_Model_GearMapper();
                 $gear= $gearMapper->fetchOne($id);
                 foreach ($gear as $value) {
                     echo "
                    <tr>
                        <td><input type='text' placeholder='Slackline kit name' name='name' value='".$value->getName()."'/></td>
                    </tr>
                    <tr>
                        <td><textarea placeholder='Slackline kit description' name='description'>".$value->getDescription()."</textarea></td>
                    </tr>
                    <tr>
                        <td><textarea placeholder='Slackline kit specification' name='specification'>".$value->getSpecification()."</textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <span>Kit image </span> <input type='file' name='image'/>
                        </td>
                    </tr>";
                 }
                  
             }
        }
        if($table=='slackline'){
            if($id==0){
                echo "<tr>
                    <td>
                        <select name='brand'>
                            <option value='0'>Choose Brand...</option>";
                                foreach ($brand as $value) {
                                    echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                                }
                    echo"</select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select name='rating'>
                            <option value='0'>Choose Rating...</option>";
                                foreach ($rating as $value) {
                                    echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                                }
                    echo"</select>
                    </td>
                </tr>
                <tr>
                    <td><input type='text' placeholder='Slackline model' name='model'/></td>
                </tr>
                <tr>
                    <td><textarea placeholder='Slackline description' name='description'></textarea></td>
                </tr>
                <tr>
                    <td><textarea placeholder='Slackline pluses' name='plus'></textarea></td>
                </tr>
                <tr>
                    <td><textarea placeholder='Slackline minuses' name='minus'></textarea></td>
                </tr>
                <tr>
                    <td><input type='text' placeholder=\"Slackline length in 'ft' and 'm'\" name='length'/></td>
                </tr>
                <tr>
                    <td><input type='text' placeholder=\"Slackline price in '$'\" name='price'/></td>
                </tr>
                <tr>
                    <td><input type='text' placeholder=\"Slackline video url\" name='video'/></td>
                </tr>
                <tr>
                    <td>
                        <select name='width'>
                            <option value='0'>Choose Width...</option>
                            <option>1\"</option>
                            <option>1.5\"</option>
                            <option>2\"</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Slackline </span> <input type='file' name='slacklineImg' required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>For image </span> <input type='file' name='forImg' required/>
                    </td>
                </tr>";
             }
             else{
                 $slackline=new Application_Model_Slackline();
                 $slacklineMapper= new Application_Model_SlacklineMapper();
                 $slackline= $slacklineMapper->fetchOne($id);
                 foreach ($slackline as $val) {
                     echo "<tr>
                                <td>
                                    <select name='brand'>
                                        <option value='0'>Choose Brand...</option>";
                                            foreach ($brand as $value) {
                                                echo "<option value='".$value->getId()."'";
                                                    if($val->getIdBrand()==$value->getName()){
                                                        echo "selected";
                                                    }
                                                echo ">".$value->getName()."</option>";
                                            }
                                echo"</select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name='rating'>
                                        <option value='0'>Choose Rating...</option>";
                                            foreach ($rating as $value) {
                                                echo "<option value='".$value->getId()."'";
                                                    if($val->getIdRating()==$value->getId()){
                                                        echo "selected";
                                                    }
                                                echo ">".$value->getName()."</option>";
                                            }
                                echo"</select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder='Slackline model' name='model' value='".$val->getModel()."'/></td>
                            </tr>
                            <tr>
                                <td><textarea placeholder='Slackline description' name='description'>".$val->getDescription()."</textarea></td>
                            </tr>
                            <tr>
                                <td><textarea placeholder='Slackline pluses' name='plus'>".$val->getPlus()."</textarea></td>
                            </tr>
                            <tr>
                                <td><textarea placeholder='Slackline minuses' name='minus'>".$val->getMinus()."</textarea></td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder=\"Slackline length in 'ft' and 'm'\" name='length' value='".$val->getLength()."'/></td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder=\"Slackline price in '$'\" name='price'value='".$val->getPrice()."'/></td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder=\"Slackline video url\" name='video' value='".$val->getVideo()."'/></td>
                            </tr>
                            <tr>
                                <td>
                                    <select name='width'>
                                        <option value='0'>Choose Width...</option>
                                        <option";if($val->getWidth()==='1"'){echo " selected";}echo ">1\"</option>
                                        <option";if($val->getWidth()==='1.5"'){echo " selected";}echo ">1.5\"</option>
                                        <option";if($val->getWidth()==='2"'){echo " selected";}echo ">2\"</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Slackline </span> <input type='file' name='slacklineImg'/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>For image </span> <input type='file' name='forImg'/>
                                </td>
                            </tr>";
                 }
             }
        }
        if($table=='setup'){
            if($id==0){
                 echo "<tr>
                            <td>
                                <select name='type'>
                                    <option value='0'>Choose type...</option>";
                                        foreach ($setupType as $value) {
                                            echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                                        }
                                   echo "</select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type='text' placeholder='Setup name' name='name'/></td>
                        </tr>
                        <tr>
                            <td><input type='text' placeholder='Setup for' name='for'/></td>
                        </tr>
                        <tr>
                            <td><textarea placeholder='Setup needed' name='needed'></textarea></td>
                        </tr>
                        <tr>
                            <td><textarea placeholder='Setup warning' name='warning'></textarea></td>
                        </tr>
                        <tr>
                            <td><textarea placeholder='Setup description' name='description'></textarea></td>
                        </tr>
                        <tr>
                            <td><input type='text' placeholder='Embede video code, ONLY URL with \"https:\"' name='video'/></td>
                        </tr>
                        <tr>
                            <td><input type='text' placeholder='Element ID' name='divId'/></td>
                        </tr>
                        <tr>
                            <td>
                                <span>Image </span> <input type='file' name='image' required/>
                            </td>
                        </tr>";
             }
             else{
                 $setup= new Application_Model_Setup();
                 $setupMapper= new Application_Model_SetupMapper();
                 $setup= $setupMapper->fetchOne($id);
                 foreach ($setup as $val) {
                    echo "<tr>
                                <td>
                                    <select name='type'>
                                        <option value='0'>Choose type...</option>";
                                            foreach ($setupType as $value) {
                                                echo "<option value='".$value->getId()."'";
                                                    if($val->getType()==$value->getId()){
                                                        echo "selected";
                                                    }
                                                echo ">".$value->getName()."</option>";
                                            }
                                       echo "</select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder='Setup name' name='name' value='".$val->getName()."'/></td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder='Setup for' name='for' value='".$val->getFor()."'/></td>
                            </tr>
                            <tr>
                                <td><textarea placeholder='Setup needed' name='needed'>".$val->getNeeded()."</textarea></td>
                            </tr>
                            <tr>
                                <td><textarea placeholder='Setup warning' name='warning'>".$val->getWarning()."</textarea></td>
                            </tr>
                            <tr>
                                <td><textarea placeholder='Setup description' name='description'>".$val->getDescription()."</textarea></td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder='Embede video code, ONLY URL with \"https:\"' name='video' value='".$val->getVIdeo()."'/></td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder='Element ID' name='divId' value='".$val->getDivId()."'/></td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Image </span> <input type='file' name='image' />
                                </td>
                            </tr>"; 
                 }
                 
             }
        }
        if($table=='typeSetup'){
            if($id==0){
                 echo "<tr>
                        <td><input type='text' placeholder='Type name' name='name' id='typeSetupName'/></td>
                    </tr>";
             }
             else{
                 $typeSetup= new Application_Model_Typesetup();
                 $typeSetupMapper= new Application_Model_TypesetupMapper();
                 $typeSetup= $typeSetupMapper->fetchOne($id);
                 foreach ($typeSetup as $value) {
                     echo "<tr>
                                <td><input type='text' placeholder='Type name' name='name' id='typeSetupName' value='".$value->getName()."'/></td>
                            </tr>";
                 }
             }
        }
        if($table=='slacklineRating'){
            if($id==0){
                 echo "
                        <tr>
                            <td><input type='text' placeholder='Rating name' name='name'/></td>
                        </tr>
                        <tr>
                            <td><input type='text' placeholder='Rating alt name for image' name='alt'/></td>
                        </tr>
                         <tr>
                            <td>
                                <span>Rating image </span> <input type='file' name='image' required/>
                            </td>
                        </tr>";
             }
             else{
                 $slacklineRating= new Application_Model_Slacklinerating();
                 $slacklineRatingMapper= new Application_Model_SlacklineratingMapper();
                 $slacklineRating= $slacklineRatingMapper->fetchOne($id);
                 foreach ($slacklineRating as $value) {
                     echo "<tr>
                                <td><input type='text' placeholder='Rating name' name='name' value='".$value->getName()."'/></td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder='Rating alt name for image' name='alt' value='".$value->getAlt()."'/></td>
                            </tr>
                             <tr>
                                <td>
                                    <span>Rating image </span> <input type='file' name='image'/>
                                </td>
                            </tr>";
                 }
             }
        }
        if($table=='brand'){
            if($id==0){
                 echo "<tr>
                        <td><input type='text' placeholder='Brand name' name='name'/></td>
                    </tr>
                     <tr>
                        <td>
                            <span>Brand image </span> <input type='file' name='image' required/>
                        </td>
                    </tr>";
             }
             else{
                 foreach ($brand as $value) {
                     if($value->getId()==$id){
                         echo "<tr>
                                    <td><input type='text' placeholder='Brand name' name='name' value='".$value->getName()."'/></td>
                                </tr>
                                 <tr>
                                    <td>
                                        <span>Brand image </span> <input type='file' name='image'/>
                                    </td>
                                </tr>";
                     }
                 }
             }
        }
        if($table=='doneTricks'){
            if($id==0){
                 echo "<tr>
                        <td>
                            <select name='type' id='doneTrickUser'>
                                <option value='0'>Choose user...</option>";
                                    foreach ($users as $value) {
                                        echo "<option value='".$value->getId()."'>".$value->getUsername()."</option>";
                                    }
                        echo "</select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name='mark' id='doneTrickTrick'>
                                <option value='0'>Choose Trick...</option>";
                                    foreach ($tricks as $value) {
                                        echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                                    }
                        echo"</select>
                        </td>
                    </tr>";
             }
             else{
                $doneTrick= new Application_Model_Donetrick();
                $doneTrickMapper= new Application_Model_DonetrickMapper();
                $doneTrick=$doneTrickMapper->fetchOne($id);
                foreach ($doneTrick as $val) {
                    echo "<tr>
                            <td>
                                <select name='type' id='doneTrickUser'>
                                    <option value='0'>Choose user...</option>";
                                        foreach ($users as $value) {
                                            echo "<option value='".$value->getId()."'";
                                            if($val->getUser()==$value->getId()){
                                                echo " selected";
                                            }
                                            echo ">".$value->getUsername()."</option>";
                                        }
                            echo "</select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name='mark' id='doneTrickTrick'>
                                    <option value='0'>Choose Trick...</option>";
                                        foreach ($tricks as $value) {
                                            echo "<option value='".$value->getId()."'";
                                            if($val->getTrick()==$value->getId()){
                                                echo " selected";
                                            }
                                            echo ">".$value->getName()."</option>";
                                        }
                            echo"</select>
                            </td>
                        </tr>";
                }
             }
        }
        if($table=='roles'){
            if($id==0){
                 echo "<tr>
                        <td><input type='text' placeholder='Role name' name='name' id='rolesName'/></td>
                    </tr>";
             }
             else{
                 $role=$roleMapper->fetchOne($id);
                 foreach ($role as $value) {
                     echo "<tr>
                            <td><input type='text' placeholder='Role name' name='name' value='".$value->getName()."' id='rolesName'/></td>
                        </tr>";
                 }
             }
        }
        if($table=='gearComment'){
            if($id==0){
                 echo "<tr>
                            <td>
                                <select name='gear' id='gearCommentGear'>
                                    <option value='0'>Choose Gear...</option>";
                                        foreach ($gears as $value) {
                                            echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                                        }
                            echo"</select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name='user' id='gearCommentUser'>
                                    <option value='0'>Choose user...</option>";
                                        foreach ($users as $value) {
                                            echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                                        }
                            echo "</select>
                            </td>
                        </tr>
                        <tr>
                            <td><textarea placeholder='Comment text' name='text' id='gearCommentText'></textarea></td>
                        </tr>
                        <tr><td><label class='active_user_editing'>Date of posting</label><input type='datetime-local' name='date'  placeholder='Date format \"YYYY-MM-DDTH:i\"' id='gearCommentDate'/></td></tr>";
             }
             else{
                 $commentGear= new Application_Model_Commentgear();
                 $commentGearMapper= new Application_Model_CommentgearMapper();
                 $commentGear=$commentGearMapper->fetchOne($id);
                 foreach ($commentGear as $val) {
                     echo "<tr>
                            <td>
                                <select name='gear' id='gearCommentGear'>
                                    <option value='0'>Choose Gear...</option>";
                                        foreach ($gears as $value) {
                                            echo "<option value='".$value->getId()."'";
                                                if($val->getGear()==$value->getId()){
                                                    echo " selected";
                                                }
                                            echo ">".$value->getName()."</option>";
                                        }
                            echo"</select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name='user' id='gearCommentUser'>
                                    <option value='0'>Choose user...</option>";
                                        foreach ($users as $value) {
                                            echo "<option value='".$value->getId()."'";
                                                if($val->getUser()==$value->getId()){
                                                    echo " selected";
                                                }
                                            echo ">".$value->getName()."</option>";
                                        }
                            echo "</select>
                            </td>
                        </tr>
                        <tr>
                            <td><textarea placeholder='Comment text' name='text' id='gearCommentText'>".$val->getText()."</textarea></td>
                        </tr>
                        <tr><td><label class='active_user_editing'>Date of posting</label><input type='datetime-local' name='date'  placeholder='Date format \"YYYY-MM-DDTH:i\"' value='".date('Y-m-d', $val->getDate())."T".date('H:i', $val->getDate())."' id='gearCommentDate'/></td></tr>";
                 }
             }
        }
        if($table=='commentSlackline'){
            if($id==0){
                 echo "
                        <tr>
                            <td>
                                <select name='slackline' id='slacklineCommentSlackline'>
                                    <option value='0'>Choose Slackline...</option>";
                                        foreach ($slacklines as $value) {
                                            echo "<option value='".$value->getId()."'>".$value->getModel()."</option>";
                                        }
                                echo "</select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <select name='user' id='slacklineCommentUser'>
                                    <option value='0'>Choose user...</option>";
                                        foreach ($users as $value) {
                                            echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                                        }
                              echo " </select>
                            </td>
                        </tr>
                        <tr>
                            <td><textarea placeholder='Comment text' name='text' id='slacklineCommentText'></textarea></td>
                        </tr>
                        <tr><td><label class='active_user_editing'>Date of posting</label><input type='datetime-local' name='datetime'  placeholder='Date format \"YYYY-MM-DDTH:i\"' id='slacklineCommentDate'/></td></tr>";
             }
             else{
                $comment= new Application_Model_Commentslackline();
                $commentMapper= new Application_Model_CommentslacklineMapper();
                $comment=$commentMapper->fetchOne($id);
                foreach ($comment as $val) {
                    echo "<tr>
                                <td>
                                    <select name='slackline' id='slacklineCommentSlackline'>
                                        <option value='0'>Choose Slackline...</option>";
                                            foreach ($slacklines as $value) {
                                            echo "<option value='".$value->getId()."'";
                                                if($val->getSlackline()==$value->getId()){
                                                    echo " selected";
                                                }
                                            echo ">".$value->getModel()."</option>";
                                        }
                                    echo "</select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name='user'  id='slacklineCommentUser'>
                                        <option value='0'>Choose user...</option>";
                                            foreach ($users as $value) {
                                            echo "<option value='".$value->getId()."'";
                                                if($val->getUser()==$value->getId()){
                                                    echo " selected";
                                                }
                                            echo ">".$value->getName()."</option>";
                                        }
                                  echo " </select>
                                </td>
                            </tr>
                            <tr>
                                <td><textarea placeholder='Comment text' name='text' id='slacklineCommentText'>".$val->getText()."</textarea></td>
                            </tr>
                            <tr><td><label class='active_user_editing'>Date of posting</label><input type='datetime-local' name='datetime'  placeholder='Date format \"YYYY-MM-DDTH:i\"' value='".date('Y-m-d', $val->getDate())."T".date('H:i', $val->getDate())."' id='slacklineCommentDate'/></td></tr>";
                }
             }
        }
        
        if($table=='user'){
            if($id == 0){
                echo "<script src='/js/ajaxScript.js'></script><legend>Add new user</legend>";
                echo "<form action='ajax/save' method='POST' id='mubs' enctype='multipart/form-data'>
                        <input type='hidden' class='ajaxTableName' value='user' name='table'/>
                        <input type='hidden' class='ajaxItemId' value='0' name='id'/>
                        <table >
                            <tr>
                                <td>
                                    <select id='userRola' name='rola'>
                                        <option value='0'>Choose role</option>";
                                            foreach ($role as $val) {
                                                if($val->getName()=='Head admin'){
                                                    continue;
                                                }
                                                echo "<option value='".$val->getId()."'>".$val->getName()."</option>";
                                            }
                                    echo "</select>
                                </td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder='Full name' id='userFullName' name='name'/></td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder='Username' id='userUsername' name='username'/></td>
                            </tr>
                            <tr>
                                <td><input type='password' placeholder='Password' id='userPassword' name='password'/></td>
                            </tr>
                            <tr>
                                <td><input type='email' placeholder='Email address' id='userEmail' name='email'/></td>
                            </tr>
                            <tr>
                                <td><input type='checkbox' id='userActive' name='active' value='1'/><label class='active_user_editing'>Active</label></td>
                            </tr>
                            <tr><td><input type='button' value='Save' class='btn btn-primary ajaxSave'/></td></tr>
                        </table>
                    </form>";
            }
            else{
                $user= new Application_Model_User();
                $userMapper= new Application_Model_UserMapper();
                $user=$userMapper->fetchOne($id);
                
                $userAditional= new Application_Model_Useradd();
                $userAditionalMapper= new Application_Model_UseraddMapper();
                $userAditional=$userAditionalMapper->fetchOne($id);
                
                foreach ($user as $val) {
                    echo "<script src='/js/ajaxScript.js'></script><legend>".$val->getName()."</legend>
                            <form action='ajax/save' method='POST' id='mubs' enctype='multipart/form-data'>
                            <input type='hidden' class='ajaxTableName' value='user' name='table'/>
                            <input type='hidden' class='ajaxItemId' value='".$val->getId()."' name='id'/>
                            <table >
                                <tr>
                                    <td>
                                        <select id='userRola' name='rola'>
                                            <option value='0'>Choose role</option>";
                                                foreach ($role as $value) {
                                                    if($value->getName()=='Head admin'){
                                                    continue;
                                                    }
                                                    echo "<option value='".$value->getId()."'";
                                                        if($val->getRole()== $value->getId()){
                                                            echo " selected";
                                                        }
                                                    echo ">".$value->getName()."</option>";
                                                }
                                        echo "</select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type='text' placeholder='Full name' value='".$val->getName()."' id='userFullName' name='name'/></td>
                                </tr>
                                <tr>
                                    <td><input type='text' placeholder='Username' value='".$val->getUsername()."' id='userUsername' name='username'/></td>
                                </tr>
                                <tr>
                                    <td><input type='password' placeholder='Password' id='userPassword' name='password'/></td>
                                </tr>
                                <tr>
                                    <td><input type='email' placeholder='Email address' value='".$val->getEmail()."' id='userEmail' name='email'/></td>
                                </tr>
                                <tr>
                                    <td><input type='checkbox'"; 
                                        if($val->getActive()==1){
                                            echo " checked";
                                        }
                                    echo " id='userActive' name='active' value='1'/><label class='active_user_editing'>Active</label></td>
                                </tr>
                                <tr><td><input type='button' value='Save' class='btn btn-primary ajaxSave'/></td></tr>
                            </table>
                        </form>";
                }
                    foreach ($userAditional as $value) {
                        echo "<legend>Aditional</legend>
                            <form action='ajax/save' method='POST' id='moderatorUserAddSave' enctype='multipart/form-data'>
                                <input type='hidden' class='ajaxTableName' value='userAdd' name='table'/>
                                <input type='hidden' class='ajaxItemId' value='".$value->getIdTable()."' name='id'/>
                                <input type='hidden' class='ajaxItemIdUser' value='".$value->getId()."' name='idUser'/>
                                <table>
                                    <tr>
                                        <td><input type='text' placeholder='example +381640123456' value='".$value->getPhone()."' name='phone' id='userAddPhone'/></td>
                                    </tr>
                                    <tr>
                                        <td><input type='text' placeholder='Facebook profile' value='".$value->getFacebook()."' name='facebook' id='userAddFacebook'/></td>
                                    </tr>
                                    <tr>
                                        <td><input type='text' placeholder='Twitter profile' value='".$value->getTwitter()."' name='twitter' id='userAddTwitter'/></td>
                                    </tr>
                                    <tr>
                                        <td><label class='active_user_editing'>Date of birth</label>
                                            <input type='date' placeholder='Date format \"YYYY-MM-DD\"' value='".date('Y-m-d',$value->getBirth())."' name='birth' id='userAddBirth'/></td>
                                    </tr>
                                     <tr>
                                        <td><label class='active_user_editing'>Slackling from</label>
                                            <input type='date'  placeholder='Date format \"YYYY-MM-DD\"' value='".date('Y-m-d',$value->getSlacklingFrom())."' name='slackingFrom' id='userAddSlackingFrom'/></td>
                                    </tr>
                                    <tr><td><input type='button' value='Save' class='btn btn-primary ajaxSave'/></td></tr>
                                </table>
                            </form>";
                    }
                }
            }
            
        if($table=='userAdmin'){
            if($id==0){
                echo "<legend>Add new user</legend>
                        <form action='ajax/save' method='POST' id='adminUser' enctype='multipart/form-data'>
                            <input type='hidden' value='user' name='table' class='ajaxTableName'/>
                            <input type='hidden' value='0' name='id' class='ajaxTableName'/>
                            <table>
                                <tr>
                                    <td>
                                        <select name='rola'>
                                            <option value='0'>Choose role</option>";
                                                foreach ($role as $value) {
                                                    echo "<option value='".$value->getId()."'>".$value->getName()."</option>";
                                                }
                                echo "</select>
                                    </td>
                                <tr>
                                    <td><input type='text' placeholder='Full name' name='name'/></td>
                                </tr>
                                <tr>
                                    <td><input type='text' placeholder='Username' name='username'/></td>
                                </tr>
                                <tr>
                                    <td><input type='password' placeholder='Password' name='password'/></td>
                                </tr>
                                <tr>
                                    <td><input type='email' placeholder='Email address' name='email'/></td>
                                </tr>
                                <tr>
                                    <td><input type='text' placeholder='Security code' name='code'/></td>
                                </tr>
                                <tr>
                                    <td><input type='checkbox' name='active'/><label class='active_user_editing'>Active</label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name='privacy'>
                                            <option value='0'>Choose privacy...</option>
                                            <option value='1'>Everybody</option>
                                            <option value='2'>Only slackliners</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>User image </span> <input type='file' name='image'/>
                                    </td>
                                </tr>
                            </table> 
                            <iframe name='upload_target' src='' style='width:0px;height:0px;border:0px solid #fff;'></iframe>
                            <input type='submit' value='Save' class='btn btn-primary'/>
                        </form>    
                        <script type='text/javascript'>
                            document.getElementById('adminUser').onsubmit=function() {
                                document.getElementById('adminUser').target = 'upload_target';
                                var marginTop=($(window).height()-140)/2;
                                var marginleft=($(window).width()-340)/2;
                                $('#ajaxResponse').html(\"<div id='ajaxResponseContent'><div id='ajaxResponseContentText'>Item has been saved!!!</div></div>\");
                                $('#ajaxResponse').css({'margin-top':marginTop,'margin-left':marginleft,'display':'block'}).animate({'opacity':0.95},500).animate({'opacity':0.95},2000).animate({'opacity':0},800);
                            };
                        </script>";
            }
            else{
                $users=$usersMapper->fetchOne($id);
                $id_user=0;
                foreach ($users as $val) {
                    $id_user=$val->getId();
                    echo "<legend>".$val->getName()."</legend>
                        <form action='ajax/save' method='POST' id='adminUser' enctype='multipart/form-data'>
                            <input type='hidden' value='user' name='table' class='ajaxTableName'/>
                            <input type='hidden' value='".$val->getId()."' name='id' class='ajaxTableName'/>
                            <table>
                                <tr>
                                    <td>
                                        <select name='rola'>
                                            <option>Choose role</option>";
                                                foreach ($role as $value) {
                                                    echo "<option value='".$value->getId()."'";
                                                    if($val->getRole()==$value->getId()){
                                                        echo " selected";
                                                    }
                                                    echo ">".$value->getName()."</option>";
                                                }
                                echo "</select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type='text' placeholder='Full name' value='".$val->getName()."' name='name'/></td>
                                </tr>
                                <tr>
                                    <td><input type='text' placeholder='Username' value='".$val->getUsername()."' name='username'/></td>
                                </tr>
                                <tr>
                                    <td><input type='text' placeholder='Password' name='password'/></td>
                                </tr>
                                <tr>
                                    <td><input type='email' placeholder='Email address' value='".$val->getEmail()."' name='email'/></td>
                                </tr>
                                <tr>
                                    <td><input type='text' placeholder='Security code' value='".$val->getCode()."' name='code'/></td>
                                </tr>
                                <tr>
                                    <td><input type='checkbox'";
                                                if($val->getActive()==1){
                                                    echo 'checked';
                                                }
                                                echo"/ name='active'><label class='active_user_editing'>Active</label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name='privacy'>
                                            <option value='0'>Choose privacy</option>
                                            <option value='1'";if($val->getPrivacy()==1){echo " selected";} echo">Everybody</option>
                                            <option value='2'";if($val->getPrivacy()==2){echo " selected";} echo">Only slackliners</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>User image </span> <input type='file' name='image'/>
                                    </td>
                                </tr>
                            </table>
                            <iframe name='upload_target' src='' style='width:0px;height:0px;border:0px solid #fff;'></iframe>
                            <input type='submit' value='Save' class='btn btn-primary'/>
                        </form>    
                        <script type='text/javascript'>
                            document.getElementById('adminUser').onsubmit=function() {
                                document.getElementById('adminUser').target = 'upload_target';
                                var marginTop=($(window).height()-140)/2;
                                var marginleft=($(window).width()-340)/2;
                                $('#ajaxResponse').html(\"<div id='ajaxResponseContent'><div id='ajaxResponseContentText'>Item has been saved!!!</div></div>\");
                                $('#ajaxResponse').css({'margin-top':marginTop,'margin-left':marginleft,'display':'block'}).animate({'opacity':0.95},500).animate({'opacity':0.95},2000).animate({'opacity':0},800);
                            };
                        </script>";
                }
                $userAditionalMapper= new Application_Model_UseraddMapper();
                $userAditional=$userAditionalMapper->fetchOne($id);
                if($userAditional== NULL){
                    echo "<legend>Aditional</legend>
                        <form action='ajax/save' method='POST'>
                        <input type='hidden' class='ajaxTableName' value='userAdd' name='table'/>
                        <input type='hidden' class='ajaxItemId' value='0' name='id'/>
                        <input type='hidden' class='ajaxItemIdUser' value='$id_user' name='idUser'/>
                        <table>
                            <tr>
                                <td><input type='text' placeholder='Phone number' id='userAddPhone'/></td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder='Facebook profile' id='userAddFacebook'/></td>
                            </tr>
                            <tr>
                                <td><input type='text' placeholder='Twitter profile' id='userAddTwitter'/></td>
                            </tr>
                            <tr>
                                <td><label class='active_user_editing'>Date of birth</label><input type='date' placeholder='Date format \"YYYY-MM-DD\"' id='userAddBirth'/></td>
                            </tr>
                             <tr>
                                <td><label class='active_user_editing'>Slackling from</label><input type='date' placeholder='Date format \"YYYY-MM-DD\"' id='userAddSlackingFrom'/></td>
                            </tr>
                            <tr>
                                <td>
                                    <select id='userAddPrivacy'>
                                        <option value='0'>Choose privacy</option>
                                        <option value='1'>Everybody</option>
                                        <option value='2'>Only slackliners</option>
                                        <option value='3'>Only me</option>
                                    </select>
                                </td>
                            </tr>
                            <tr><td><input type='button' value='Save' class='btn btn-primary ajaxSave'/></td></tr>
                        </table>
                    </form><script src=\"/js/ajaxScript.js\"></script>";
                }
                else{
                    foreach ($userAditional as $val) {
                        echo "<legend>Aditional</legend>
                             <form action='ajax/save' method='POST'>
                            <input type='hidden' class='ajaxTableName' value='userAdd' name='table'/>
                            <input type='hidden' class='ajaxItemId' value='".$val->getIdTable()."' name='id'/>
                            <input type='hidden' class='ajaxItemIdUser' value='$id_user' name='idUser'/>
                                <table>
                                    <tr>
                                        <td><input type='text' placeholder='Phone number'value='".$val->getPhone()."' id='userAddPhone'/></td>
                                    </tr>
                                    <tr>
                                        <td><input type='text' placeholder='Facebook profile'value='".$val->getFacebook()."' id='userAddFacebook'/></td>
                                    </tr>
                                    <tr>
                                        <td><input type='text' placeholder='Twitter profile'value='".$val->getTwitter()."' id='userAddTwitter'/></td>
                                    </tr>
                                    <tr>
                                        <td><label class='active_user_editing'>Date of birth</label><input type='date' placeholder='Date format \"YYYY-MM-DD\"' value='".date('Y-m-d', $val->getBirth())."' id='userAddBirth'/></td>
                                    </tr>
                                     <tr>
                                        <td><label class='active_user_editing'>Slackling from</label><input type='date' placeholder='Date format \"YYYY-MM-DD\"' value='".date('Y-m-d', $val->getSlacklingFrom())."' id='userAddSlackingFrom'/></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select id='userAddPrivacy'>
                                                <option value='0'>Choose privacy</option>
                                                <option value='1'";if($val->getPrivacy()==1){echo " selected";} echo">Everybody</option>
                                                <option value='2'";if($val->getPrivacy()==2){echo " selected";} echo">Only slackliners</option>
                                                <option value='3'";if($val->getPrivacy()==3){echo " selected";} echo">Only me</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr><td><input type='button' value='Save' class='btn btn-primary ajaxSave'/></td></tr>
                                </table>
                            </form><script src=\"/js/ajaxScript.js\"></script>";
                    }
                }
            }
        }
    }

    public function deleteAction()
    {
        $table=$_POST['table'];
        $id=$_POST['id'];
        if($table=='menu'){
            $mapperMenu= new Application_Model_MenuMapper();
            $mapperMenu->delete($id);
        }
        if($table=='trickType'){
            $mapperTrickType= new Application_Model_TricktypeMapper();
            $mapperTrickType->delete($id);
        }
        if($table=='trickWeight'){
            $mapperTrickWeight= new Application_Model_TrickweightMapper();
            $mapperTrickWeight->delete($id);
        }
        if($table=='trick'){
            $mapperTrick= new Application_Model_TrickMapper();
            $mapperTrick->delete($id);
        }
        if($table=='trickWeightMark'){
            $mapperTrickWeightMark= new Application_Model_TrickweightmarkMapper();
            $mapperTrickWeightMark->delete($id);
        }
        if($table=='gear'){
            $mapperGear= new Application_Model_GearMapper();
            $mapperGear->delete($id);
        }
        if($table=='slackline'){
            $mapperSlackline= new Application_Model_SlacklineMapper();
            $mapperSlackline->delete($id);
        }
        if($table=='setup'){
            $mapperSetup= new Application_Model_SetupMapper();
            $mapperSetup->delete($id);
        }
        if($table=='setupType'){
            $mapperTypeSetup= new Application_Model_TypesetupMapper();
            $mapperTypeSetup->delete($id);
        }
        if($table=='rating'){
            $mapperRating= new Application_Model_SlacklineratingMapper();
            $mapperRating->delete($id);
        }
        if($table=='brand'){
            $mapperBrand= new Application_Model_BrandMapper();
            $mapperBrand->delete($id);
        }
        if($table=='doneTricks'){
            $mapperDoneTricks= new Application_Model_DonetrickMapper();
            $mapperDoneTricks->delete($id);
        }
        if($table=='roles'){
            $mapperRoles= new Application_Model_RolesMapper();
            $mapperRoles->delete($id);
        }
        if($table=='gearComment'){
            $mapperCommentGear= new Application_Model_CommentgearMapper();
            $mapperCommentGear->delete($id);
        }
        if($table=='slacklineComment'){
            $mapperCommentSlackline= new Application_Model_CommentslacklineMapper();
            $mapperCommentSlackline->delete($id);
        }
        if($table=='users'){
            $mapperUser= new Application_Model_UserMapper();
            $mapperUser->delete($id);
            $mapperUserAdd= new Application_Model_UseraddMapper();
            $mapperUserAdd->delete($id);
            
        }
    }

    public function saveAction()
    {
        $table=$_POST['table'];
        $id=$_POST['id'];
        
        if($table=='menu'){
            $menu=new Application_Model_Menu();
            $menuMapper= new Application_Model_MenuMapper();
            $menu->setText($_POST['text'])->setHref($_POST['controller'])->setPosition($_POST['position'])->setRole($_POST['rola'])->setAction($_POST['action']);
            if($id!=0){
               $menu->setId($id);
            }
            $menuMapper->save($menu);
        }
        if($table=='trickWeight'){
            $object=new Application_Model_Trickweight();
            $objectMapper= new Application_Model_TrickweightMapper();
            $object->setName($_POST['name']);
            if($id!=0){
               $object->setId($id);
            }
            $objectMapper->save($object);
        }
        if($table=='trickWeightMark'){
            $object=new Application_Model_Trickweightmark();
            $objectMapper= new Application_Model_TrickweightmarkMapper();
            $object->setName($_POST['name'])->setIdWeight($_POST['weight']);
            if($id!=0){
               $object->setId($id);
            }
            $objectMapper->save($object);
        }
        if($table=='typeSetup'){
            $object=new Application_Model_Typesetup();
            $objectMapper= new Application_Model_TypesetupMapper();
            $object->setName($_POST['name']);
            if($id!=0){
               $object->setId($id);
            }
            $objectMapper->save($object);
        }
        if($table=='doneTricks'){
            $object=new Application_Model_Donetrick();
            $objectMapper= new Application_Model_DonetrickMapper();
            $object->setUser($_POST['user'])->setTrick($_POST['trick']);
            if($id!=0){
               $object->setId($id);
            }
            $objectMapper->save($object);
        }
        if($table=='doneTricksProfile'){
            $objectMapper= new Application_Model_DonetrickMapper();
            $tm= new Application_Model_TrickMapper();
            $tricks=  explode(',', $_POST['trick']);
            $id=$_POST['user'];
            $count=  count($tricks);
            $array=array();
            for($i=0;$i<$count-1;$i++){
                $t= new Application_Model_Trick();
                $t=$tm->fetchOne($tricks[$i]);
                $array[]=$t[0]->getId();
            }
            foreach ($array as $value) {
                $object=new Application_Model_Donetrick();
                $object->setUser($id)->setTrick($value);
                $objectMapper->save($object);
                echo $id;
            }
                
        }
        if($table=='roles'){
            $object=new Application_Model_Roles();
            $objectMapper= new Application_Model_RolesMapper();
            $object->setName($_POST['name']);
            if($id!=0){
               $object->setId($id);
            }
            $objectMapper->save($object);
        }
        
        if($table=='gearComment'){
            $year= explode('-',explode('T',$_POST['date'])[0])[0];
            $month=explode('-',explode('T',$_POST['date'])[0])[1];
            $day=explode('-',explode('T',$_POST['date'])[0])[2];
            $hour=explode(':',explode('T',$_POST['date'])[1])[0];
            $minute=explode(':',explode('T',$_POST['date'])[1])[1];
            
            $object=new Application_Model_Commentgear();
            $objectMapper= new Application_Model_CommentgearMapper();
            $object->setGear($_POST['gear'])->setUser($_POST['user'])->setText($_POST['text'])->setDate(mktime($hour, $minute, 30, $month, $day, $year));
            if($id!=0){
               $object->setId($id);
            }
            $objectMapper->save($object);
        }
        if($table=='commentSlackline'){
            if(isset($_POST['date'])){
                $year= explode('-',explode('T',$_POST['date'])[0])[0];
                $month=explode('-',explode('T',$_POST['date'])[0])[1];
                $day=explode('-',explode('T',$_POST['date'])[0])[2];
                $hour=explode(':',explode('T',$_POST['date'])[1])[0];
                $minute=explode(':',explode('T',$_POST['date'])[1])[1];
                $time=mktime($hour, $minute, 30, $month, $day, $year);
            } 
            else{
                $time= time();
            }
            $object=new Application_Model_Commentslackline();
            $objectMapper= new Application_Model_CommentslacklineMapper();
            $object->setSlackline($_POST['slackline'])->setUser($_POST['user'])->setText($_POST['text'])->setDate($time);
            if($id!=0){
               $object->setId($id);
            }
            $objectMapper->save($object);
            if(isset($_POST['comment'])){
                $model=$_POST['slacklineName'];
                $this->_redirect("/gear/slackline/type/$model");
            }
        }
        
        if($table=='user'){
            $user=new Application_Model_User();
            $userMapper= new Application_Model_UserMapper();
            $active=0;
            $privacy=1;
            if(isset($_POST['active'])){
                $active=1;
            }
            if(isset($_POST['privacy'])){
                if($_POST['privacy']!=0){
                    $privacy=$_POST['privacy'];
                }
            }
            $code=sha1(md5($_POST['username']));
            if(isset($_POST['code'])){
                if(strlen($_POST['code'])>10){
                    $code=$_POST['code'];
                }
            }
            
            $fileDirectory=APPLICATION_PATH.'\\..\\public\\img\\users\\profile\\';
            $upload= new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination($fileDirectory);
            $fileName=$upload->getFileName('image');
            if ($fileName != NULL) {
                $extension=explode('.', $fileName);
                $ext=$extension[count($extension)-1];
                $newFileName=  implode('_',explode(' ',$_POST['username'])).'.'.$ext;
                $upload->addFilter('Rename',array('target'=>$newFileName));
                $upload->addValidator('Extension',true,array('jpg','jpeg','png','gif'));
                $upload->setOptions(array('useByteString'=>FALSE));
                if($upload->receive()){
                    $user->setImg($newFileName);
                }else{
                    $user->setImg('default.gif');
                }
            }
            else{
                if($id==0)
                    $user->setImg('default.gif');
            }
            $user->setRole($_POST['rola'])->setName($_POST['name'])->setUsername($_POST['username'])->setPassword($_POST['password'])->setEmail($_POST['email'])->setCode($code)->setActive($active)->setPrivacy($privacy);
            if($id!=0){
               $user->setId($id);
            }
            $userMapper->save($user);
        }
        
        if($table=='userAdd'){
            $user=new Application_Model_Useradd();
            $userMapper= new Application_Model_UseraddMapper();
            if(isset($_POST['phone'])){
                $user->setPhone($_POST['phone']);
            }
            if($_POST['facebook']!=''){
                $user->setFacebook($_POST['facebook']);
            }
            if(isset($_POST['twitter'])){
                $user->setTwitter($_POST['twitter']);
            }
            if(isset($_POST['birth'])){
                $year= explode('-',$_POST['birth'])[0];
                $month=explode('-',$_POST['birth'])[1];
                $day=explode('-',$_POST['birth'])[2];
                $user->setBirth(mktime(0, 0, 0, $month, $day, $year));
            }
            if(isset($_POST['slackingFrom'])){
                $year= explode('-',$_POST['slackingFrom'])[0];
                $month=explode('-',$_POST['slackingFrom'])[1];
                $day=explode('-',$_POST['slackingFrom'])[2];
                $user->setSlacklingFrom(mktime(0, 0, 0, $month, $day, $year));
            }
            if(isset($_POST['privacy'])){
                $user->setPrivacy($_POST['privacy']);
            }
            $user->setId($_POST['idUser']);
            if($id!=0){
               $user->setIdTable($id);
            }
            $userMapper->save($user);
        }
        
        if($table=='trickType'){
            $name=$_POST['trickTypeName'];
            $fileDirectory=APPLICATION_PATH.'\\..\\public\\img\\tricks\\type\\';
            $upload= new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination($fileDirectory);
            $fileName=$upload->getFileName('trickTypeImage');
            $object=new Application_Model_Tricktype();
            $objectMapper= new Application_Model_TricktypeMapper();
            if ($fileName != NULL) {
                $extension=explode('.', $fileName);
                $ext=$extension[count($extension)-1];
                $newFileName=  strtolower($name).'.'.$ext;
                $upload->addFilter('Rename',array('target'=>$newFileName));
                $upload->addValidator('Extension',true,array('jpg','jpeg','png','gif'));
                $upload->setOptions(array('useByteString'=>FALSE));
                if($upload->receive()){
                    $object->setImg($newFileName);
                }
            }
            if($id!=0){
               $object->setId($id);
            }
            $object->setName($name);
            $objectMapper->save($object);
        }
        if($table=='trick'){
            $type=$_POST['trickType'];
            $mark=$_POST['trickMark'];
            $trickName=$_POST['trickName'];
            $name=strtolower(implode('_',explode(' ',$_POST['trickName'])));
            $description=$_POST['trickDescription'];
            $video=$_POST['trickVideo'];
            $fileDirectory=APPLICATION_PATH.'\\..\\public\\img\\tricks\\';
            $upload= new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination($fileDirectory);
            $fileName=$upload->getFileName('trickImage');
            $object=new Application_Model_Trick();
            $objectMapper= new Application_Model_TrickMapper();
            if ($fileName != NULL) {
                $extension=explode('.', $fileName);
                $ext=$extension[count($extension)-1];
                $newFileName=$name.'.'.$ext;
                $upload->addFilter('Rename',array('target'=>$newFileName));
                $upload->addValidator('Extension',true,array('jpg','jpeg','png','gif'));
                $upload->setOptions(array('useByteString'=>FALSE));
                if($upload->receive()){
                    $object->setImage($newFileName);
                }
            }
            if($id!=0){
               $object->setId($id);
            }
            $object->setName($trickName)->setIdMark($mark)->setIdType($type)->setDescription($description)->setVideo($video);
            $objectMapper->save($object);
        }
        if($table=='gear'){
            $gearName=$_POST['name'];
            $description=$_POST['description'];
            $specification=$_POST['specification'];
            $name=strtolower(implode('_',explode(' ',$_POST['name'])));
            $fileDirectory=APPLICATION_PATH.'\\..\\public\\img\\gear\\';
            $upload= new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination($fileDirectory);
            $fileName=$upload->getFileName('image');
            $object=new Application_Model_Gear();
            $objectMapper= new Application_Model_GearMapper();
            if ($fileName != NULL) {
                $extension=explode('.', $fileName);
                $ext=$extension[count($extension)-1];
                $newFileName=$name.'.'.$ext;
                $upload->addFilter('Rename',array('target'=>$newFileName));
                $upload->addValidator('Extension',true,array('jpg','jpeg','png','gif'));
                $upload->setOptions(array('useByteString'=>FALSE));
                if($upload->receive()){
                    $object->setImage($newFileName);
                }
            }
            if($id!=0){
               $object->setId($id);
            }
            $object->setName($gearName)->setDescription($description)->setSpecification($specification);
            $objectMapper->save($object);
        }
        if($table=='slackline'){
            $brand=$_POST['brand'];
            $rating=$_POST['rating'];
            $model=$_POST['model'];
            $description=$_POST['description'];
            $plus=$_POST['plus'];
            $minus=$_POST['minus'];
            $length=$_POST['length'];
            $price=$_POST['price'];
            $video=$_POST['video'];
            $width=$_POST['width'];
            $name=strtolower(implode('_',explode(' ',$model)));
            
            $fileDirectory=APPLICATION_PATH.'\\..\\public\\img\\slacklines\\';
            $upload= new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination($fileDirectory);
            $fileName=$upload->getFileName('slacklineImg');
            
            $fileDirectory1=APPLICATION_PATH.'\\..\\public\\img\\slacklines\\slackline_for\\';
            $upload1= new Zend_File_Transfer_Adapter_Http();
            $upload1->setDestination($fileDirectory1);
            $fileName1=$upload1->getFileName('forImg');
            
            $object=new Application_Model_Slackline();
            $objectMapper= new Application_Model_SlacklineMapper();
            if ($fileName != NULL) {
                $extension=explode('.', $fileName);
                $ext=$extension[count($extension)-1];
                $newFileName=$name.'.'.$ext;
                $upload->addFilter('Rename',array('target'=>$newFileName));
                $upload->addValidator('Extension',true,array('jpg','jpeg','png','gif'));
                $upload->setOptions(array('useByteString'=>FALSE));
                if($upload->receive()){
                    $object->setImage($newFileName);
                }
            }
            if ($fileName1 != NULL) {
                $extension=explode('.', $fileName1);
                $ext=$extension[count($extension)-1];
                $newFileName1=$name.'.'.$ext;
                $upload1->addFilter('Rename',array('target'=>$newFileName1));
                $upload1->addValidator('Extension',true,array('jpg','jpeg','png','gif'));
                $upload1->setOptions(array('useByteString'=>FALSE));
                if($upload1->receive()){
                    $object->setForImg($newFileName1);
                }
            }
            if($id!=0){
               $object->setId($id);
            }
            $object->setModel($model)->setIdBrand($brand)->setIdRating($rating)->setDescription($description)->setWidth($width)->setLength($length)->setPrice($price)->setPlus($plus)->setMinus($minus)->setVideo($video);
            $objectMapper->save($object);
        }
        if($table=='setup'){
            $type=$_POST['type'];
            $name=$_POST['name'];
            $for=$_POST['for'];
            $needed=$_POST['needed'];
            $warning=$_POST['warning'];
            $description=$_POST['description'];
            $video=$_POST['video'];
            $divId=$_POST['divId'];
            $nameOfFile=strtolower(implode('_',explode(' ',$name)));
            $fileDirectory=APPLICATION_PATH.'\\..\\public\\img\\setup\\';
            $upload= new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination($fileDirectory);
            $fileName=$upload->getFileName('image');
            $object=new Application_Model_Setup();
            $objectMapper= new Application_Model_SetupMapper();
            if ($fileName != NULL) {
                $extension=explode('.', $fileName);
                $ext=$extension[count($extension)-1];
                $newFileName=$nameOfFile.'.'.$ext;
                $upload->addFilter('Rename',array('target'=>$newFileName));
                $upload->addValidator('Extension',true,array('jpg','jpeg','png','gif'));
                $upload->setOptions(array('useByteString'=>FALSE));
                if($upload->receive()){
                    $object->setImg($newFileName);
                }
            }
            if($id!=0){
               $object->setId($id);
            }
            $object->setType($type)->setName($name)->setFor($for)->setNeeded($needed)->setWarning($warning)->setDescription($description)->setVideo($video)->setDivId($divId);
            $objectMapper->save($object);
        }
        if($table=='slacklineRating'){
            $name=$_POST['name'];
            $alt=$_POST['alt'];
            $nameOfFile=strtolower(implode('_',explode(' ',$name)));
            $fileDirectory=APPLICATION_PATH.'\\..\\public\\img\\rating\\';
            $upload= new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination($fileDirectory);
            $fileName=$upload->getFileName('image');
            $object=new Application_Model_Slacklinerating();
            $objectMapper= new Application_Model_SlacklineratingMapper();
            if ($fileName != NULL) {
                $extension=explode('.', $fileName);
                $ext=$extension[count($extension)-1];
                $newFileName=$nameOfFile.'.'.$ext;
                $upload->addFilter('Rename',array('target'=>$newFileName));
                $upload->addValidator('Extension',true,array('jpg','jpeg','png','gif'));
                $upload->setOptions(array('useByteString'=>FALSE));
                if($upload->receive()){
                    $object->setImg($newFileName);
                }
            }
            if($id!=0){
               $object->setId($id);
            }
            $object->setName($name)->setAlt($alt);
            $objectMapper->save($object);
        }
        if($table=='brand'){
            $name=$_POST['name'];
            $nameOfFile=strtolower(implode('_',explode(' ',$name)));
            $fileDirectory=APPLICATION_PATH.'\\..\\public\\img\\brand\\';
            $upload= new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination($fileDirectory);
            $fileName=$upload->getFileName('image');
            $object=new Application_Model_Brand();
            $objectMapper= new Application_Model_BrandMapper();
            if ($fileName != NULL) {
                $extension=explode('.', $fileName);
                $ext=$extension[count($extension)-1];
                $newFileName=$nameOfFile.'.'.$ext;
                $upload->addFilter('Rename',array('target'=>$newFileName));
                $upload->addValidator('Extension',true,array('jpg','jpeg','png','gif'));
                $upload->setOptions(array('useByteString'=>FALSE));
                if($upload->receive()){
                    $object->setImg($newFileName);
                }
            }
            if($id!=0){
               $object->setId($id);
            }
            $object->setName($name);
            $objectMapper->save($object);
        }
    }


}





