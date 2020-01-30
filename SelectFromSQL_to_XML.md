``` sql
Declare @Employee table (EmployeeID int,First_Name varchar(50),Last_Name varchar(50))
Insert into @Employee values
(1,'John','Smith'),
(2,'Jane','Doe'  )


Select (Select CreatedBy='My Organization',CreateDate=GetDate() For XML Path('RecordHeader'),Type ) 
      ,(Select * From @Employee For XML Path('Employee'),Type ) 
For XML Path ('Employees'),Type
```
  
Returns  

``` sql
<Employees>
  <RecordHeader>
    <CreatedBy>My Organization</CreatedBy>
    <CreateDate>2016-10-18T16:09:48.110</CreateDate>
  </RecordHeader>
  <Employee>
    <EmployeeID>1</EmployeeID>
    <First_Name>John</First_Name>
    <Last_Name>Smith</Last_Name>
  </Employee>
  <Employee>
    <EmployeeID>2</EmployeeID>
    <First_Name>Jane</First_Name>
    <Last_Name>Doe</Last_Name>
  </Employee>
</Employees>
``` 
  
    
 more information https://www.red-gate.com/simple-talk/sql/learn-sql-server/using-the-for-xml-clause-to-return-query-results-as-xml/
