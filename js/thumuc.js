 
var t =  new Date().getTime(); 

  var trang = 'thumuc_0.php?t=' + t ;
  load_mod_load('content0',trang);
     trang = 'thumuc_1.php?t=' + t ;
 load_mod_load('content1',trang);
   trang = 'thumuc_2.php?t=' + t ;
  load_mod_load('content2',trang);
   trang = 'thumuc_3.php?t=' + t ;
   load_mod_load('content3',trang);
 
 

function loadtrang(tentrang,tab)
{
 	var i ,menu;
	
	  content = "content" + tab ;
	 
 	for (i=0;i<=3;i++)
	{
		
		   menu = "menu" + i   ;
		   content = "content" + i ;
		    if (i == parseInt(tab))
			{ 
			
				document.getElementById(content).style.display ='';
				document.getElementById(menu).style.background ='#FFFFFF';				
			} else
			{  
				document.getElementById(content).style.display ='none';
				document.getElementById(menu).style.background ='';
			}					 
	}
	 
}

function setthumuc(id,ten,muc)

{ 
 
  document.getElementById('tenthumuc').innerHTML  = ten  ;
  
return false ;
}
function ShowHide(Name)
{
		if (document.getElementById(Name).style.display =='')
		{
				document.getElementById(Name).style.display ='None';					
		}
			else
		{
				document.getElementById(Name).style.display ='';			
		}	
}