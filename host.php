Port = 53640 
Server =  game:GetService("NetworkServer") 
HostService = game:GetService("RunService")Server:Start(Port,20) 
game:GetService("RunService"):Run() 
function onJoined(NewPlayer) 
NewPlayer:LoadCharacter(true) 
while wait() do 
if NewPlayer.Character.Humanoid.Health == 0 then 
wait(5) 
NewPlayer:LoadCharacter(true)
elseif NewPlayer.Character.Parent  == nil then 
wait(5) 
NewPlayer:LoadCharacter(true) 
end 
end 
end 
game.Players.PlayerAdded:connect(onJoined) 

function onChatted(msg, speaker)
    
    source = string.lower(speaker.Name)
    msg = string.lower(msg)
    -- Note: This one is NOT caps sensitive

    if msg == ";ec" then
        speaker.Character.Humanoid.Health = 0
    end
end

function onPlayerEntered(newPlayer)
        newPlayer.Chatted:connect(function(msg) onChatted(msg, newPlayer) end) 
end
 
game.Players.ChildAdded:connect(onPlayerEntered)
