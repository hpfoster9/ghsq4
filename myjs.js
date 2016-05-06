function signUpTeacher(name, password, callback)
{
    $.ajax(
    {
        type: "POST",
        url: "signUpTeacher.php",
        data: 
        {
            Teachers_name: name,
            Teachers_password: password
        },
        success: function(value)
        {
            if(typeof callback === "function")
                callback($.parseJSON(value));
        }
    });
}

function login(){   //this is just fake stuff for now
            var name = document.getElementById("name").value;
            var pass = document.getElementById("pass").value;
            console.log(name + " " + pass);
}
   
var teacherArray = [];
var current;


function addTeacher(name, password){
        this.name = name;
        this.password = password;
        this.class = [];
}

teacherArray.push(new addTeacher("dave", "password"));
teacherArray.push(new addTeacher("molly", "password"));
teacherArray.push(new addTeacher("sophie", "password"));

function signUp(){
        var name = document.getElementById("signUpName").value;
        var password = document.getElementById("signUpPassword").value;
        
        signUpTeacher(name, password, function(data)
        {
            console.log(data);

            /*addStudents('Ajax', '1234', '001007461', function(data2)
            {
                console.log(data2);
            });
            */
        });

        teacherArray.push(new addTeacher(name, password));
        console.log(teacherArray);
        show('teacher');
        current = name;
        console.log(current);
         
}

function addStudents(){
        console.log(teacherArray);
        console.log(current);
        var result = teacherArray.filter(function( obj ) {
                return obj.name == current;
        });
        var student = document.getElementById("signUpID").value;
        var grade = document.getElementById("signUpGrade").value;
        var temp = [];
        temp.push(student);
        temp.push(grade);
        console.log(result);
        result[0].class.push(temp);
        console.log(teacherArray);
        
        document.getElementById("signUpID").value = "";
        document.getElementById("signUpGrade").value = "";
        
}


function show(type){   //this sets all elements invisible except the argument that is passd into it 
                
                var knew = document.getElementById("new");
                var teacher = document.getElementById("new_teacher");
                var grade = document.getElementById("gradebook");
                
                type = eval(type);
                knew.setAttribute("hidden","true");
                teacher.setAttribute("hidden","true");
                grade.setAttribute("hidden","true");
                
                
                
                type.removeAttribute("hidden");
        }
        
        
        
        
        
 function makeTable(type){
                refreshTable("gradeBookTable");
                console.log("tried to make the table");
                var table = document.getElementById("gradeBookTable"); 
                
                
                var result = teacherArray.filter(function( obj ) {
                return obj.name == current;
        });
                typeArray = result[0].class;
                
                console.log(typeArray.length);
                console.log(table);
                console.log(typeArray);
                for(i=0; i<typeArray.length; i++){      
                        
                         
                                var j = 0; // First Cell
                                var k = 1; // Second Cell
                                var newTR = table.insertRow(i+1);
                                var newTD1 = newTR.insertCell(j);
                        
                                newTD1.innerHTML = typeArray[i][0];
                                var newTD2 = newTR.insertCell(k);
                                newTD2.innerHTML = typeArray[i][1];
                                
                                
                        }
                }
                
        
        function refreshTable(tableName){
                console.log(tableName)
                var table = document.getElementById(tableName);
                 console.log(table)
                while(table.rows.length >1){   //for all of the rows in the table
                        table.deleteRow(1);   //delete all rows except for the top one
                }
                console.log("just refreshed the table");
                
        }
      
