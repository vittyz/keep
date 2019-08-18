Const DeleteReadOnly = TRUE
Const ForReading = 1, ForAppending = 8

Set objShell = CreateObject("Wscript.Shell")

'Find Path that this script store

strPath = objShell.CurrentDirectory

currentScriptPath = Replace(WScript.ScriptFullName, WScript.ScriptName, "")
currentScriptPath = Replace(currentScriptPath,"\bin","")

'Prepare require folder

logFolder = currentScriptPath & "\logs"
dataFolder = currentScriptPath & "\data"
dwhFolder = currentScriptPath & "\dataDWH"


set objFSO = CreateObject("Scripting.FileSystemObject")

if Not objFSO.FolderExists(logFolder) then
'Create Folder
    objFSO.CreateFolder(logFolder)
end if

if Not objFSO.FolderExists(dataFolder) then
'Create Folder
    objFSO.CreateFolder(dataFolder)
else
'Clear All file in folder
    objFSO.DeleteFile(dataFolder & "\*"), DeleteReadOnly
end if

if Not objFSO.FolderExists(dwhFolder) then
'Create Folder
    objFSO.CreateFolder(dwhFolder)
else
'Clear All file in folder
    objFSO.DeleteFile(dwhFolder & "\*"), DeleteReadOnly
end if

set objFSO = nothing

' --- Start Prepare for Write Log ---

Set objFSOLog=CreateObject("Scripting.FileSystemObject")
logFile=logFolder & "\log_" & curDate & ".txt"
Set objLogFile = objFSOLog.OpenTextFile( logFile, ForAppending, True )
'Set objLogFile = objFSOLog.CreateTextFile(logFile,True)

' --- End Prepare for Write Log ---

' ======== Start Business Logic Here ======== 

writeLog("## Start Job : Export Sompo Insurance")

writeLog("1. Run SQL Command for Extract Data")

Set oShell = CreateObject ("WScript.Shell") 
oShell.run "cmd.exe /C pause "
Set oShell = nothing

writeLog("## End Job : Export Sompo Insurance")

' ======== End Business Logic ======== 

objLogFile.Close
set objFSOLog = nothing

Function timeStamp()
    Dim t 
    t = Now
    timeStamp = Year(t) & "-" & _
    Right("0" & Month(t),2)  & "-" & _
    Right("0" & Day(t),2)  & " " & _  
    Right("0" & Hour(t),2) &  ":"  & _
    Right("0" & Minute(t),2) & ":" & _    
    Right("0" & Second(t),2) 
End Function

Function curDate()
    Dim t 
    t = Now
    curDate = Year(t) & "-" & _
    Right("0" & Month(t),2)  & "-" & _
    Right("0" & Day(t),2)  
End Function

Function writeLog(txtLog)
    objLogFile.Write timeStamp  & " - "
    objLogFile.Write txtLog
    objLogFile.Write vbCrLf
End Function
