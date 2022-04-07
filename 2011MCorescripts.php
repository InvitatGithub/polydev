--- ATTENTION!!! There are site-specific ids at the end of this script!!!!!!!!!!!!!!!!!!!!

delay(0, function()

if game.CoreGui.Version < 3 then return end -- peace out if we aren't using the right client

local gui = game:GetService("CoreGui").RobloxGui

-- A couple of necessary functions
local function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end
local function waitForProperty(instance, property)
	while not instance[property] do
		instance.Changed:wait()
	end
end

waitForChild(game,"Players")
waitForProperty(game.Players,"LocalPlayer")
local player = game.Players.LocalPlayer

-- First up is the current loadout
local CurrentLoadout = Instance.new("Frame")
CurrentLoadout.Name = "CurrentLoadout"
CurrentLoadout.Position = UDim2.new(0.5, -240, 1, -85)
CurrentLoadout.Size = UDim2.new(0, 480, 0, 48)
CurrentLoadout.BackgroundTransparency = 1
CurrentLoadout.RobloxLocked = true
CurrentLoadout.Parent = gui

local Debounce = Instance.new("BoolValue")
Debounce.Name = "Debounce"
Debounce.RobloxLocked = true
Debounce.Parent = CurrentLoadout

local BackpackButton = Instance.new("ImageButton")
BackpackButton.RobloxLocked = true
BackpackButton.Visible = false
BackpackButton.Name = "BackpackButton"
BackpackButton.BackgroundTransparency = 1
BackpackButton.Image = "rbxasset://textures/ui/backpackButton.png"
BackpackButton.Position = UDim2.new(0.5, -195, 1, -30)
BackpackButton.Size = UDim2.new(0,107,0,26)
waitForChild(gui,"ControlFrame")
BackpackButton.Parent = gui.ControlFrame

for i = 0, 9 do
	local slotFrame = Instance.new("Frame")
	slotFrame.RobloxLocked = true
	slotFrame.BackgroundColor3 = Color3.new(0,0,0)
	slotFrame.BackgroundTransparency = 1
	slotFrame.BorderColor3 = Color3.new(1,1,1)
	slotFrame.Name = "Slot" .. tostring(i)
	if i == 0 then
		slotFrame.Position = UDim2.new(0.9,0,0,0)
	else
		slotFrame.Position = UDim2.new((i - 1) * 0.1,0,0,0)
	end
	slotFrame.Size = UDim2.new(0.1,0,1,0)
	slotFrame.Parent = CurrentLoadout
end

local TempSlot = Instance.new("ImageButton")
TempSlot.Name = "TempSlot"
TempSlot.Active = true
TempSlot.Size = UDim2.new(1,0,1,0)
TempSlot.Style = Enum.ButtonStyle.RobloxButton
TempSlot.Visible = false
TempSlot.RobloxLocked = true
TempSlot.Parent = CurrentLoadout

	-- TempSlot Children
	local GearReference = Instance.new("ObjectValue")
	GearReference.Name = "GearReference"
	GearReference.RobloxLocked = true
	GearReference.Parent = TempSlot

	local Kill = Instance.new("BoolValue")
	Kill.Name = "Kill"
	Kill.RobloxLocked = true
	Kill.Parent = TempSlot

	local GearImage = Instance.new("ImageLabel")
	GearImage.Name = "GearImage"
	GearImage.BackgroundTransparency = 1
	GearImage.Position = UDim2.new(0,-7,0,-7)
	GearImage.Size = UDim2.new(1,14,1,14)
	GearImage.ZIndex = 2
	GearImage.RobloxLocked = true
	GearImage.Parent = TempSlot

	local SlotNumber = Instance.new("TextLabel")
	SlotNumber.Name = "SlotNumber"
	SlotNumber.BackgroundTransparency = 1
	SlotNumber.BorderSizePixel = 0
	SlotNumber.Font = Enum.Font.ArialBold
	SlotNumber.FontSize = Enum.FontSize.Size18
	SlotNumber.Position = UDim2.new(0,-7,0,-7)
	SlotNumber.Size = UDim2.new(0,10,0,15)
	SlotNumber.TextColor3 = Color3.new(1,1,1)
	SlotNumber.TextTransparency = 0
	SlotNumber.TextXAlignment = Enum.TextXAlignment.Left
	SlotNumber.TextYAlignment = Enum.TextYAlignment.Bottom
	SlotNumber.ZIndex = 4
	SlotNumber.RobloxLocked = true
	SlotNumber.Parent = TempSlot
	
	local SlotNumberDownShadow = SlotNumber:clone()
	SlotNumberDownShadow.Name = "SlotNumberDownShadow"
	SlotNumberDownShadow.TextColor3 = Color3.new(0,0,0)
	SlotNumberDownShadow.ZIndex = 3
	SlotNumberDownShadow.Position = UDim2.new(0,-6,0,-6)
	SlotNumberDownShadow.Parent = TempSlot
	
	local SlotNumberUpShadow = SlotNumberDownShadow:clone()
	SlotNumberUpShadow.Name = "SlotNumberUpShadow"
	SlotNumberUpShadow.Position = UDim2.new(0,-8,0,-8)
	SlotNumberUpShadow.Parent = TempSlot

	local GearText = Instance.new("TextLabel")
	GearText.RobloxLocked = true
	GearText.Name = "GearText"
	GearText.BackgroundTransparency = 1
	GearText.Font = Enum.Font.Arial
	GearText.FontSize = Enum.FontSize.Size14
	GearText.Position = UDim2.new(0,-8,0,-8)
	GearText.ZIndex = 2
	GearText.Size = UDim2.new(1,16,1,16)
	GearText.Text = ""
	GearText.TextColor3 = Color3.new(1,1,1)
	GearText.TextWrap = true
	GearText.Parent = TempSlot

--- Great, now lets make the inventory!

local Backpack = Instance.new("Frame")
Backpack.Visible = false
Backpack.Name = "Backpack"
Backpack.Position = UDim2.new(0.5,0,0.5,0)
Backpack.Size = UDim2.new(0,0,0,0)
Backpack.Style = Enum.FrameStyle.RobloxSquare
Backpack.RobloxLocked = true
Backpack.Parent = gui
Backpack.Active = true

	-- Backpack Children
	local SwapSlot = Instance.new("BoolValue")
	SwapSlot.RobloxLocked = true
	SwapSlot.Name = "SwapSlot"
	SwapSlot.Parent = Backpack
		
		-- SwapSlot Children
		local Slot = Instance.new("IntValue")
		Slot.RobloxLocked = true
		Slot.Name = "Slot"
		Slot.Parent = SwapSlot
		
		local GearButton = Instance.new("ObjectValue")
		GearButton.RobloxLocked = true
		GearButton.Name = "GearButton"
		GearButton.Parent = SwapSlot
	
	local Tabs = Instance.new("Frame")
	Tabs.Name = "Tabs"
	Tabs.Visible = false
	Tabs.RobloxLocked = true
	Tabs.BackgroundColor3 = Color3.new(0,0,0)
	Tabs.BackgroundTransparency = 0.5
	Tabs.BorderSizePixel = 0
	Tabs.Position = UDim2.new(0,-8,-0.1,-8)
	Tabs.Size = UDim2.new(1,16,0.1,0)
	Tabs.Parent = Backpack
	
		-- Tabs Children
		local InventoryButton = Instance.new("ImageButton")
		InventoryButton.RobloxLocked = true
		InventoryButton.Name = "InventoryButton"
		InventoryButton.Size = UDim2.new(0.12,0,1,0)
		InventoryButton.Style = Enum.ButtonStyle.RobloxButton
		InventoryButton.Selected = true
		InventoryButton.Parent = Tabs
		
			-- InventoryButton Children
			local InventoryText = Instance.new("TextLabel")
			InventoryText.RobloxLocked = true
			InventoryText.Name = "InventoryText"
			InventoryText.BackgroundTransparency = 1
			InventoryText.Font = Enum.Font.ArialBold
			InventoryText.FontSize = Enum.FontSize.Size18
			InventoryText.Position = UDim2.new(0,-7,0,-7)
			InventoryText.Size = UDim2.new(1,14,1,14)
			InventoryText.Text = "Gear"
			InventoryText.TextColor3 = Color3.new(1,1,1)
			InventoryText.Parent = InventoryButton
			
		local closeButton = Instance.new("TextButton")
		closeButton.RobloxLocked = true
		closeButton.Name = "CloseButton"
		closeButton.Font = Enum.Font.ArialBold
		closeButton.FontSize = Enum.FontSize.Size24
		closeButton.Position = UDim2.new(1,-33,0,2)
		closeButton.Size = UDim2.new(0,30,0,30)
		closeButton.Style = Enum.ButtonStyle.RobloxButton
		closeButton.Text = "X"
		closeButton.TextColor3 = Color3.new(1,1,1)
		closeButton.Parent = Tabs
	
	local Gear = Instance.new("Frame")
	Gear.Name = "Gear"
	Gear.RobloxLocked = true
	Gear.BackgroundTransparency = 1
	Gear.Size  = UDim2.new(1,0,1,0)
	Gear.Parent = Backpack

		-- Gear Children
		local GearGrid = Instance.new("Frame")
		GearGrid.RobloxLocked = true
		GearGrid.Name = "GearGrid"
		GearGrid.Size = UDim2.new(0.69,0,1,0)
		GearGrid.Style = Enum.FrameStyle.RobloxSquare
		GearGrid.Parent = Gear
		
			-- GearGrid Children
			local ResetFrame = Instance.new("Frame")
			ResetFrame.RobloxLocked = true
			ResetFrame.Name = "ResetFrame"
			ResetFrame.Visible = false
			ResetFrame.BackgroundTransparency = 1
			ResetFrame.Size = UDim2.new(0,32,0,64)
			ResetFrame.Parent = GearGrid
			
				-- ResetFrame Children
				local ResetImageLabel = Instance.new("ImageLabel")
				ResetImageLabel.RobloxLocked = true
				ResetImageLabel.Name = "ResetImageLabel"
				ResetImageLabel.Image = "rbxasset://textures/ui/ResetIcon.png"
				ResetImageLabel.BackgroundTransparency = 1
				ResetImageLabel.Position = UDim2.new(0,0,0,-12)
				ResetImageLabel.Size = UDim2.new(0.8,0,0.79,0)
				ResetImageLabel.ZIndex = 2
				ResetImageLabel.Parent = ResetFrame
				
				local ResetButtonBorder = Instance.new("TextButton")
				ResetButtonBorder.RobloxLocked = true
				ResetButtonBorder.Name = "ResetButtonBorder"
				ResetButtonBorder.Position = UDim2.new(0,-3,0,-7)
				ResetButtonBorder.Size = UDim2.new(1,0,0.64,0)
				ResetButtonBorder.Style = Enum.ButtonStyle.RobloxButton
				ResetButtonBorder.Text = ""
				ResetButtonBorder.Parent = ResetFrame
				
				
			local SearchFrame = Instance.new("Frame")
			SearchFrame.RobloxLocked = true
			SearchFrame.Name = "SearchFrame"
			SearchFrame.BackgroundTransparency = 1
			SearchFrame.Position = UDim2.new(1,-150,0,0)
			SearchFrame.Size = UDim2.new(0,150,0,25)
			SearchFrame.Parent = GearGrid
			
				-- SearchFrame Children
				local SearchButton = Instance.new("ImageButton")
				SearchButton.RobloxLocked = true
				SearchButton.Name = "SearchButton"
				SearchButton.Size = UDim2.new(0,25,0,25)
				SearchButton.BackgroundTransparency = 1
				SearchButton.Image = "rbxasset://textures/ui/SearchIcon.png"
				SearchButton.Parent = SearchFrame
				
				local SearchBoxFrame = Instance.new("TextButton")
				SearchBoxFrame.RobloxLocked = true
				SearchBoxFrame.Position = UDim2.new(0,26,0,0)
				SearchBoxFrame.Size = UDim2.new(0,121,0,25)
				SearchBoxFrame.Name = "SearchBoxFrame"
				SearchBoxFrame.Text = ""
				SearchBoxFrame.Style = Enum.ButtonStyle.RobloxButton
				SearchBoxFrame.Parent = SearchFrame
				
					-- SearchBoxFrame Children
					local SearchBox = Instance.new("TextBox")
					SearchBox.RobloxLocked = true
					SearchBox.Name = "SearchBox"
					SearchBox.BackgroundTransparency = 1
					SearchBox.Font = Enum.Font.ArialBold
					SearchBox.FontSize = Enum.FontSize.Size12
					SearchBox.Position = UDim2.new(0,-5,0,-5)
					SearchBox.Size = UDim2.new(1,10,1,10)
					SearchBox.TextColor3 = Color3.new(1,1,1)
					SearchBox.TextXAlignment = Enum.TextXAlignment.Left
					SearchBox.ZIndex = 2
					SearchBox.TextWrap = true
					SearchBox.Text = "Search..."
					SearchBox.Parent = SearchBoxFrame
			
			local GearButton = Instance.new("ImageButton")
			GearButton.RobloxLocked = true
			GearButton.Visible = false
			GearButton.Name = "GearButton"
			GearButton.Size = UDim2.new(0,64,0,64)
			GearButton.Style = Enum.ButtonStyle.RobloxButton
			GearButton.Parent = GearGrid

				-- GearButton Children
				local GearReference = Instance.new("ObjectValue")
				GearReference.RobloxLocked = true
				GearReference.Name = "GearReference"
				GearReference.Parent = GearButton
				
				local GreyOutButton = Instance.new("Frame")
				GreyOutButton.RobloxLocked = true
				GreyOutButton.Name = "GreyOutButton"
				GreyOutButton.BackgroundTransparency = 0.5
				GreyOutButton.Size = UDim2.new(1,0,1,0)
				GreyOutButton.Active = true
				GreyOutButton.Visible = false
				GreyOutButton.ZIndex = 3
				GreyOutButton.Parent = GearButton
				
				local GearText = Instance.new("TextLabel")
				GearText.RobloxLocked = true
				GearText.Name = "GearText"
				GearText.BackgroundTransparency = 1
				GearText.Font = Enum.Font.Arial
				GearText.FontSize = Enum.FontSize.Size14
				GearText.Position = UDim2.new(0,-8,0,-8)
				GearText.Size = UDim2.new(1,16,1,16)
				GearText.Text = ""
				GearText.ZIndex = 2
				GearText.TextColor3 = Color3.new(1,1,1)
				GearText.TextWrap = true
				GearText.Parent = GearButton

		local GearGridScrollingArea = Instance.new("Frame")
		GearGridScrollingArea.RobloxLocked = true
		GearGridScrollingArea.Name = "GearGridScrollingArea"
		GearGridScrollingArea.Position = UDim2.new(0.7,0,0,0)
		GearGridScrollingArea.Size = UDim2.new(0,17,1,0)
		GearGridScrollingArea.BackgroundTransparency = 1
		GearGridScrollingArea.Parent = Gear

		local GearLoadouts = Instance.new("Frame")
		GearLoadouts.RobloxLocked = true
		GearLoadouts.Name = "GearLoadouts"
		GearLoadouts.BackgroundTransparency = 1
		GearLoadouts.Position = UDim2.new(0.7,23,0.5,1)
		GearLoadouts.Size = UDim2.new(0.3,-23,0.5,-1)
		GearLoadouts.Parent = Gear
		GearLoadouts.Visible = false
		
			-- GearLoadouts Children
			local GearLoadoutsHeader = Instance.new("Frame")
			GearLoadoutsHeader.RobloxLocked = true
			GearLoadoutsHeader.Name = "GearLoadoutsHeader"
			GearLoadoutsHeader.BackgroundColor3 = Color3.new(0,0,0)
			GearLoadoutsHeader.BackgroundTransparency = 0.2
			GearLoadoutsHeader.BorderColor3 = Color3.new(1,0,0)
			GearLoadoutsHeader.Size = UDim2.new(1,2,0.15,-1)
			GearLoadoutsHeader.Parent = GearLoadouts

				-- GearLoadoutsHeader Children
				local LoadoutsHeaderText = Instance.new("TextLabel")
				LoadoutsHeaderText.RobloxLocked = true
				LoadoutsHeaderText.Name = "LoadoutsHeaderText"
				LoadoutsHeaderText.BackgroundTransparency = 1
				LoadoutsHeaderText.Font = Enum.Font.ArialBold
				LoadoutsHeaderText.FontSize = Enum.FontSize.Size18
				LoadoutsHeaderText.Size = UDim2.new(1,0,1,0)
				LoadoutsHeaderText.Text = "Loadouts"
				LoadoutsHeaderText.TextColor3 = Color3.new(1,1,1)
				LoadoutsHeaderText.Parent = GearLoadoutsHeader
	
				local GearLoadoutsScrollingArea = GearGridScrollingArea:clone()
				GearLoadoutsScrollingArea.RobloxLocked = true
				GearLoadoutsScrollingArea.Name = "GearLoadoutsScrollingArea"
				GearLoadoutsScrollingArea.Position = UDim2.new(1,-15,0.15,2)
				GearLoadoutsScrollingArea.Size = UDim2.new(0,17,0.85,-2)
				GearLoadoutsScrollingArea.Parent = GearLoadouts

				local LoadoutsList = Instance.new("Frame")
				LoadoutsList.RobloxLocked = true
				LoadoutsList.Name = "LoadoutsList"
				LoadoutsList.Position = UDim2.new(0,0,0.15,2)
				LoadoutsList.Size = UDim2.new(1,-17,0.85,-2)
				LoadoutsList.Style = Enum.FrameStyle.RobloxSquare
				LoadoutsList.Parent = GearLoadouts


		local GearPreview = Instance.new("Frame")
		GearPreview.RobloxLocked = true
		GearPreview.Name = "GearPreview"
		GearPreview.Position = UDim2.new(0.7,23,0,0)
		GearPreview.Size = UDim2.new(0.3,-23,0.5,-1)
		GearPreview.Style = Enum.FrameStyle.RobloxRound
		GearPreview.Parent = Gear
		
			-- GearPreview Children
			local GearStats = Instance.new("Frame")
			GearStats.RobloxLocked = true
			GearStats.Name = "GearStats"
			GearStats.BackgroundTransparency = 1
			GearStats.Position = UDim2.new(0,0,0.75,0)
			GearStats.Size = UDim2.new(1,0,0.25,0)
			GearStats.Parent = GearPreview
				
				-- GearStats Children
				local GearName = Instance.new("TextLabel")
				GearName.RobloxLocked = true
				GearName.Name = "GearName"
				GearName.BackgroundTransparency = 1
				GearName.Font = Enum.Font.ArialBold
				GearName.FontSize = Enum.FontSize.Size18
				GearName.Position = UDim2.new(0,-3,0,0)
				GearName.Size = UDim2.new(1,6,1,5)
				GearName.Text = ""
				GearName.TextColor3 = Color3.new(1,1,1)
				GearName.TextWrap = true
				GearName.Parent = GearStats
				
			local GearImage = Instance.new("ImageLabel")
			GearImage.RobloxLocked = true
			GearImage.Name = "GearImage"
			GearImage.Image = ""
			GearImage.BackgroundTransparency = 1
			GearImage.Position = UDim2.new(0.125,0,0,0)
			GearImage.Size = UDim2.new(0.75,0,0.75,0)
			GearImage.Parent = GearPreview
			
				--GearImage Children
				local GearIcons = Instance.new("Frame")
				GearIcons.BackgroundColor3 = Color3.new(0,0,0)
				GearIcons.BackgroundTransparency = 0.5
				GearIcons.BorderSizePixel = 0
				GearIcons.RobloxLocked = true
				GearIcons.Name = "GearIcons"
				GearIcons.Position = UDim2.new(0.4,2,0.85,-2)
				GearIcons.Size = UDim2.new(0.6,0,0.15,0)
				GearIcons.Visible = false
				GearIcons.Parent = GearImage
				
					-- GearIcons Children
					local GenreImage = Instance.new("ImageLabel")
					GenreImage.RobloxLocked = true
					GenreImage.Name = "GenreImage"
					GenreImage.BackgroundColor3 = Color3.new(102/255,153/255,1)
					GenreImage.BackgroundTransparency = 0.5
					GenreImage.BorderSizePixel = 0
					GenreImage.Size = UDim2.new(0.25,0,1,0)
					GenreImage.Parent = GearIcons
					
					local AttributeOneImage = GenreImage:clone()
					AttributeOneImage.RobloxLocked = true
					AttributeOneImage.Name = "AttributeOneImage"
					AttributeOneImage.BackgroundColor3 = Color3.new(1,51/255,0)
					AttributeOneImage.Position = UDim2.new(0.25,0,0,0)
					AttributeOneImage.Parent = GearIcons
					
					local AttributeTwoImage = GenreImage:clone()
					AttributeTwoImage.RobloxLocked = true
					AttributeTwoImage.Name = "AttributeTwoImage"
					AttributeTwoImage.BackgroundColor3 = Color3.new(153/255,1,153/255)
					AttributeTwoImage.Position = UDim2.new(0.5,0,0,0)
					AttributeTwoImage.Parent = GearIcons
					
					local AttributeThreeImage = GenreImage:clone()
					AttributeThreeImage.RobloxLocked = true
					AttributeThreeImage.Name = "AttributeThreeImage"
					AttributeThreeImage.BackgroundColor3 = Color3.new(0,0.5,0.5)
					AttributeThreeImage.Position = UDim2.new(0.75,0,0,0)
					AttributeThreeImage.Parent = GearIcons
					

-- Backpack Resizer (handles all backpack resizing junk)
--game:GetService("ScriptContext"):AddCoreScript(53878053,Backpack,"BackpackResizer")
dofile("rbxasset://scripts\\cores\\BackpackResizer.lua")

end)

-- RBXGUI START --
local RbxGuiLib = {}

local function ScopedConnect(parentInstance, instance, event, signalFunc, syncFunc, removeFunc)
	local eventConnection = nil

	--Connection on parentInstance is scoped by parentInstance (when destroyed, it goes away)
	local tryConnect = function()
		if game:IsAncestorOf(parentInstance) then
			--Entering the world, make sure we are connected/synced
			if not eventConnection then
				eventConnection = instance[event]:connect(signalFunc)
				if syncFunc then syncFunc() end
			end
		else
			--Probably leaving the world, so disconnect for now
			if eventConnection then
				eventConnection:disconnect()
				if removeFunc then removeFunc() end
			end
		end
	end

	--Hook it up to ancestryChanged signal
	local connection = parentInstance.AncestryChanged:connect(tryConnect)
	
	--Now connect us if we're already in the world
	tryConnect()
	
	return connection
end

local function CreateButtons(frame, buttons, yPos, ySize)
	local buttonNum = 1
	local buttonObjs = {}
	for i, obj in ipairs(buttons) do 
		local button = Instance.new("TextButton")
		button.Name = "Button" .. buttonNum
		button.Font = Enum.Font.Arial
		button.FontSize = Enum.FontSize.Size18
		button.AutoButtonColor = true
		button.Style = Enum.ButtonStyle.RobloxButtonDefault 
		button.Text = obj.Text
		button.TextColor3 = Color3.new(1,1,1)
		button.MouseButton1Click:connect(obj.Function)
		button.Parent = frame
		buttonObjs[buttonNum] = button

		buttonNum = buttonNum + 1
	end
	local numButtons = buttonNum-1

	if numButtons == 1 then
		frame.Button1.Position = UDim2.new(0.35, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.4,0,ySize.Scale, ySize.Offset)
	elseif numButtons == 2 then
		frame.Button1.Position = UDim2.new(0.1, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.8/3,0, ySize.Scale, ySize.Offset)

		frame.Button2.Position = UDim2.new(0.55, 0, yPos.Scale, yPos.Offset)
		frame.Button2.Size = UDim2.new(.35,0, ySize.Scale, ySize.Offset)
	elseif numButtons >= 3 then
		local spacing = .1 / numButtons
		local buttonSize = .9 / numButtons

		buttonNum = 1
		while buttonNum <= numButtons do
			buttonObjs[buttonNum].Position = UDim2.new(spacing*buttonNum + (buttonNum-1) * buttonSize, 0, yPos.Scale, yPos.Offset)
			buttonObjs[buttonNum].Size = UDim2.new(buttonSize, 0, ySize.Scale, ySize.Offset)
			buttonNum = buttonNum + 1
		end
	end
end

local function setSliderPos(newAbsPosX,slider,sliderPosition,bar,steps)

	local newStep = steps - 1 --otherwise we really get one more step than we want
	
	local relativePosX = math.min(1, math.max(0, (newAbsPosX - bar.AbsolutePosition.X) / bar.AbsoluteSize.X ) )
	local wholeNum, remainder = math.modf(relativePosX * newStep)
	if remainder > 0.5 then
		wholeNum = wholeNum + 1
	end
	relativePosX = wholeNum/newStep

	local result = math.ceil(relativePosX * newStep)
	if sliderPosition.Value ~= (result + 1) then --onky update if we moved a step
		sliderPosition.Value = result + 1
		
		if relativePosX == 1 then
			slider.Position = UDim2.new(1,-slider.AbsoluteSize.X,slider.Position.Y.Scale,slider.Position.Y.Offset)
		else
			slider.Position = UDim2.new(relativePosX,0,slider.Position.Y.Scale,slider.Position.Y.Offset)
		end
	end
	
end

local function cancelSlide(areaSoak)
	areaSoak.Visible = false
	if areaSoakMouseMoveCon then areaSoakMouseMoveCon:disconnect() end
end

RbxGuiLib.CreateStyledMessageDialog = function(title, message, style, buttons)
	local frame = Instance.new("Frame")
	frame.Size = UDim2.new(0.5, 0, 0, 165)
	frame.Position = UDim2.new(0.25, 0, 0.5, -72.5)
	frame.Name = "MessageDialog"
	frame.Active = true
	frame.Style = Enum.FrameStyle.RobloxRound	
	
	local styleImage = Instance.new("ImageLabel")
	styleImage.Name = "StyleImage"
	styleImage.BackgroundTransparency = 1
	styleImage.Position = UDim2.new(0,5,0,15)
	if style == "error" or style == "Error" then
		styleImage.Size = UDim2.new(0, 71, 0, 71)
		styleImage.Image = "rbxasset://textures/ui/Error.png"
	elseif style == "notify" or style == "Notify" then
		styleImage.Size = UDim2.new(0, 71, 0, 71)
		styleImage.Image = "rbxasset://textures/ui/Notify.png"
	elseif style == "confirm" or style == "Confirm" then
		styleImage.Size = UDim2.new(0, 74, 0, 76)
		styleImage.Image = "rbxasset://textures/ui/Confirm.png"
	else
		return RbxGuiLib.CreateMessageDialog(title,message,buttons)
	end
	styleImage.Parent = frame
	
	local titleLabel = Instance.new("TextLabel")
	titleLabel.Name = "Title"
	titleLabel.Text = title
	titleLabel.BackgroundTransparency = 1
	titleLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	titleLabel.Position = UDim2.new(0, 80, 0, 0)
	titleLabel.Size = UDim2.new(1, -80, 0, 40)
	titleLabel.Font = Enum.Font.ArialBold
	titleLabel.FontSize = Enum.FontSize.Size36
	titleLabel.TextXAlignment = Enum.TextXAlignment.Center
	titleLabel.TextYAlignment = Enum.TextYAlignment.Center
	titleLabel.Parent = frame

	local messageLabel = Instance.new("TextLabel")
	messageLabel.Name = "Message"
	messageLabel.Text = message
	messageLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	messageLabel.Position = UDim2.new(0.025, 80, 0, 45)
	messageLabel.Size = UDim2.new(0.95, -80, 0, 55)
	messageLabel.BackgroundTransparency = 1
	messageLabel.Font = Enum.Font.Arial
	messageLabel.FontSize = Enum.FontSize.Size18
	messageLabel.TextWrap = true
	messageLabel.TextXAlignment = Enum.TextXAlignment.Left
	messageLabel.TextYAlignment = Enum.TextYAlignment.Top
	messageLabel.Parent = frame

	CreateButtons(frame, buttons, UDim.new(0, 105), UDim.new(0, 40) )

	return frame
end

RbxGuiLib.CreateMessageDialog = function(title, message, buttons)
	local frame = Instance.new("Frame")
	frame.Size = UDim2.new(0.5, 0, 0.5, 0)
	frame.Position = UDim2.new(0.25, 0, 0.25, 0)
	frame.Name = "MessageDialog"
	frame.Active = true
	frame.Style = Enum.FrameStyle.RobloxRound

	local titleLabel = Instance.new("TextLabel")
	titleLabel.Name = "Title"
	titleLabel.Text = title
	titleLabel.BackgroundTransparency = 1
	titleLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	titleLabel.Position = UDim2.new(0, 0, 0, 0)
	titleLabel.Size = UDim2.new(1, 0, 0.15, 0)
	titleLabel.Font = Enum.Font.ArialBold
	titleLabel.FontSize = Enum.FontSize.Size36
	titleLabel.TextXAlignment = Enum.TextXAlignment.Center
	titleLabel.TextYAlignment = Enum.TextYAlignment.Center
	titleLabel.Parent = frame

	local messageLabel = Instance.new("TextLabel")
	messageLabel.Name = "Message"
	messageLabel.Text = message
	messageLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	messageLabel.Position = UDim2.new(0.025, 0, 0.175, 0)
	messageLabel.Size = UDim2.new(0.95, 0, .55, 0)
	messageLabel.BackgroundTransparency = 1
	messageLabel.Font = Enum.Font.Arial
	messageLabel.FontSize = Enum.FontSize.Size18
	messageLabel.TextWrap = true
	messageLabel.TextXAlignment = Enum.TextXAlignment.Left
	messageLabel.TextYAlignment = Enum.TextYAlignment.Top
	messageLabel.Parent = frame

	CreateButtons(frame, buttons, UDim.new(0.8,0), UDim.new(0.15, 0))

	return frame
end

RbxGuiLib.CreateDropDownMenu = function(items, onSelect, forRoblox)
	local width = UDim.new(0, 100)
	local height = UDim.new(0, 32)

	local xPos = 0.055
	local frame = Instance.new("Frame")
	frame.Name = "DropDownMenu"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(width, height)

	local dropDownMenu = Instance.new("TextButton")
	dropDownMenu.Name = "DropDownMenuButton"
	dropDownMenu.TextWrap = true
	dropDownMenu.TextColor3 = Color3.new(1,1,1)
	dropDownMenu.Text = "Choose One"
	dropDownMenu.Font = Enum.Font.ArialBold
	dropDownMenu.FontSize = Enum.FontSize.Size18
	dropDownMenu.TextXAlignment = Enum.TextXAlignment.Left
	dropDownMenu.TextYAlignment = Enum.TextYAlignment.Center
	dropDownMenu.BackgroundTransparency = 1
	dropDownMenu.AutoButtonColor = true
	dropDownMenu.Style = Enum.ButtonStyle.RobloxButton
	dropDownMenu.Size = UDim2.new(1,0,1,0)
	dropDownMenu.Parent = frame
	dropDownMenu.ZIndex = 2

	local dropDownIcon = Instance.new("ImageLabel")
	dropDownIcon.Name = "Icon"
	dropDownIcon.Active = false
	dropDownIcon.Image = "rbxasset://textures/ui/DropDown.png"
	dropDownIcon.BackgroundTransparency = 1
	dropDownIcon.Size = UDim2.new(0,11,0,6)
	dropDownIcon.Position = UDim2.new(1,-11,0.5, -2)
	dropDownIcon.Parent = dropDownMenu
	dropDownIcon.ZIndex = 2
	
	local itemCount = #items
	local dropDownItemCount = #items
	local useScrollButtons = false
	if dropDownItemCount > 6 then
		useScrollButtons = true
		dropDownItemCount = 6
	end
	
	local droppedDownMenu = Instance.new("TextButton")
	droppedDownMenu.Name = "List"
	droppedDownMenu.Text = ""
	droppedDownMenu.BackgroundTransparency = 1
	--droppedDownMenu.AutoButtonColor = true
	droppedDownMenu.Style = Enum.ButtonStyle.RobloxButton
	droppedDownMenu.Visible = false
	droppedDownMenu.Active = true	--Blocks clicks
	droppedDownMenu.Position = UDim2.new(0,0,0,0)
	droppedDownMenu.Size = UDim2.new(1,0, (1 + dropDownItemCount)*.8, 0)
	droppedDownMenu.Parent = frame
	droppedDownMenu.ZIndex = 2

	local choiceButton = Instance.new("TextButton")
	choiceButton.Name = "ChoiceButton"
	choiceButton.BackgroundTransparency = 1
	choiceButton.BorderSizePixel = 0
	choiceButton.Text = "ReplaceMe"
	choiceButton.TextColor3 = Color3.new(1,1,1)
	choiceButton.TextXAlignment = Enum.TextXAlignment.Left
	choiceButton.TextYAlignment = Enum.TextYAlignment.Center
	choiceButton.BackgroundColor3 = Color3.new(1, 1, 1)
	choiceButton.Font = Enum.Font.Arial
	choiceButton.FontSize = Enum.FontSize.Size18
	if useScrollButtons then
		choiceButton.Size = UDim2.new(1,-13, .8/((dropDownItemCount + 1)*.8),0) 
	else
		choiceButton.Size = UDim2.new(1, 0, .8/((dropDownItemCount + 1)*.8),0) 
	end
	choiceButton.TextWrap = true
	choiceButton.ZIndex = 2

	local dropDownSelected = false

	local scrollUpButton 
	local scrollDownButton
	local scrollMouseCount = 0

	local setZIndex = function(baseZIndex)
		droppedDownMenu.ZIndex = baseZIndex +1
		if scrollUpButton then
			scrollUpButton.ZIndex = baseZIndex + 3
		end
		if scrollDownButton then
			scrollDownButton.ZIndex = baseZIndex + 3
		end
		
		local children = droppedDownMenu:GetChildren()
		if children then
			for i, child in ipairs(children) do
				if child.Name == "ChoiceButton" then
					child.ZIndex = baseZIndex + 2
				elseif child.Name == "ClickCaptureButton" then
					child.ZIndex = baseZIndex
				end
			end
		end
	end

	local scrollBarPosition = 1
	local updateScroll = function()
		if scrollUpButton then
			scrollUpButton.Active = scrollBarPosition > 1 
		end
		if scrollDownButton then
			scrollDownButton.Active = scrollBarPosition + dropDownItemCount <= itemCount 
		end

		local children = droppedDownMenu:GetChildren()
		if not children then return end

		local childNum = 1			
		for i, obj in ipairs(children) do
			if obj.Name == "ChoiceButton" then
				if childNum < scrollBarPosition or childNum >= scrollBarPosition + dropDownItemCount then
					obj.Visible = false
				else
					obj.Position = UDim2.new(0,0,((childNum-scrollBarPosition+1)*.8)/((dropDownItemCount+1)*.8),0)
					obj.Visible = true
				end
				obj.TextColor3 = Color3.new(1,1,1)
				obj.BackgroundTransparency = 1

				childNum = childNum + 1
			end
		end
	end
	local toggleVisibility = function()
		dropDownSelected = not dropDownSelected

		dropDownMenu.Visible = not dropDownSelected
		droppedDownMenu.Visible = dropDownSelected
		if dropDownSelected then
			setZIndex(4)
		else
			setZIndex(2)
		end
		if useScrollButtons then
			updateScroll()
		end
	end
	droppedDownMenu.MouseButton1Click:connect(toggleVisibility)

	local updateSelection = function(text)
		local foundItem = false
		local children = droppedDownMenu:GetChildren()
		local childNum = 1
		if children then
			for i, obj in ipairs(children) do
				if obj.Name == "ChoiceButton" then
					if obj.Text == text then
						obj.Font = Enum.Font.ArialBold
						foundItem = true			
						scrollBarPosition = childNum
					else
						obj.Font = Enum.Font.Arial
					end
					childNum = childNum + 1
				end
			end
		end
		if not text then
			dropDownMenu.Text = "Choose One"
			scrollBarPosition = 1
		else
			if not foundItem then
				error("Invalid Selection Update -- " .. text)
			end

			if scrollBarPosition + dropDownItemCount > itemCount + 1 then
				scrollBarPosition = itemCount - dropDownItemCount + 1
			end

			dropDownMenu.Text = text
		end
	end
	
	local function scrollDown()
		if scrollBarPosition + dropDownItemCount <= itemCount then
			scrollBarPosition = scrollBarPosition + 1
			updateScroll()
			return true
		end
		return false
	end
	local function scrollUp()
		if scrollBarPosition > 1 then
			scrollBarPosition = scrollBarPosition - 1
			updateScroll()
			return true
		end
		return false
	end
	
	if useScrollButtons then
		--Make some scroll buttons
		scrollUpButton = Instance.new("ImageButton")
		scrollUpButton.Name = "ScrollUpButton"
		scrollUpButton.BackgroundTransparency = 1
		scrollUpButton.Image = "rbxasset://textures/ui/scrollbuttonUp.png"
		scrollUpButton.Size = UDim2.new(0,17,0,17) 
		scrollUpButton.Position = UDim2.new(1,-11,(1*.8)/((dropDownItemCount+1)*.8),0)
		scrollUpButton.MouseButton1Click:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollUpButton.MouseLeave:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollUpButton.MouseButton1Down:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
	
				scrollUp()
				local val = scrollMouseCount
				wait(0.5)
				while val == scrollMouseCount do
					if scrollUp() == false then
						break
					end
					wait(0.1)
				end				
			end)

		scrollUpButton.Parent = droppedDownMenu

		scrollDownButton = Instance.new("ImageButton")
		scrollDownButton.Name = "ScrollDownButton"
		scrollDownButton.BackgroundTransparency = 1
		scrollDownButton.Image = "rbxasset://textures/ui/scrollbuttonDown.png"
		scrollDownButton.Size = UDim2.new(0,17,0,17) 
		scrollDownButton.Position = UDim2.new(1,-11,1,-11)
		scrollDownButton.Parent = droppedDownMenu
		scrollDownButton.MouseButton1Click:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollDownButton.MouseLeave:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollDownButton.MouseButton1Down:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1

				scrollDown()
				local val = scrollMouseCount
				wait(0.5)
				while val == scrollMouseCount do
					if scrollDown() == false then
						break
					end
					wait(0.1)
				end				
			end)	

		local scrollbar = Instance.new("ImageLabel")
		scrollbar.Name = "ScrollBar"
		scrollbar.Image = "rbxasset://textures/ui/scrollbar.png"
		scrollbar.BackgroundTransparency = 1
		scrollbar.Size = UDim2.new(0, 18, (dropDownItemCount*.8)/((dropDownItemCount+1)*.8), -(17) - 11 - 4)
		scrollbar.Position = UDim2.new(1,-11,(1*.8)/((dropDownItemCount+1)*.8),17+2)
		scrollbar.Parent = droppedDownMenu
	end

	for i,item in ipairs(items) do
		-- needed to maintain local scope for items in event listeners below
		local button = choiceButton:clone()
		if forRoblox then
			button.RobloxLocked = true
		end		
		button.Text = item
		button.Parent = droppedDownMenu
		button.MouseButton1Click:connect(function()
			--Remove Highlight
			button.TextColor3 = Color3.new(1,1,1)
			button.BackgroundTransparency = 1

			updateSelection(item)
			onSelect(item)

			toggleVisibility()
		end)
		button.MouseEnter:connect(function()
			--Add Highlight	
			button.TextColor3 = Color3.new(0,0,0)
			button.BackgroundTransparency = 0
		end)

		button.MouseLeave:connect(function()
			--Remove Highlight
			button.TextColor3 = Color3.new(1,1,1)
			button.BackgroundTransparency = 1
		end)
	end

	--This does the initial layout of the buttons	
	updateScroll()

	local bigFakeButton = Instance.new("TextButton")
	bigFakeButton.BackgroundTransparency = 1
	bigFakeButton.Name = "ClickCaptureButton"
	bigFakeButton.Size = UDim2.new(0, 4000, 0, 3000)
	bigFakeButton.Position = UDim2.new(0, -2000, 0, -1500)
	bigFakeButton.ZIndex = 1
	bigFakeButton.Text = ""
	bigFakeButton.Parent = droppedDownMenu
	bigFakeButton.MouseButton1Click:connect(toggleVisibility)

	dropDownMenu.MouseButton1Click:connect(toggleVisibility)
	return frame, updateSelection
end

RbxGuiLib.CreatePropertyDropDownMenu = function(instance, property, enum)

	local items = enum:GetEnumItems()
	local names = {}
	local nameToItem = {}
	for i,obj in ipairs(items) do
		names[i] = obj.Name
		nameToItem[obj.Name] = obj
	end

	local frame
	local updateSelection
	frame, updateSelection = RbxGuiLib.CreateDropDownMenu(names, function(text) instance[property] = nameToItem[text] end)

	ScopedConnect(frame, instance, "Changed", 
		function(prop)
			if prop == property then
				updateSelection(instance[property].Name)
			end
		end,
		function()
			updateSelection(instance[property].Name)
		end)

	return frame
end

RbxGuiLib.GetFontHeight = function(font, fontSize)
	if font == nil or fontSize == nil then
		error("Font and FontSize must be non-nil")
	end

	if font == Enum.Font.Legacy then
		if fontSize == Enum.FontSize.Size8 then
			return 12
		elseif fontSize == Enum.FontSize.Size9 then
			return 14
		elseif fontSize == Enum.FontSize.Size10 then
			return 15
		elseif fontSize == Enum.FontSize.Size11 then
			return 17
		elseif fontSize == Enum.FontSize.Size12 then
			return 18
		elseif fontSize == Enum.FontSize.Size14 then
			return 21
		elseif fontSize == Enum.FontSize.Size18 then
			return 27
		elseif fontSize == Enum.FontSize.Size24 then
			return 36
		elseif fontSize == Enum.FontSize.Size36 then
			return 54
		elseif fontSize == Enum.FontSize.Size48 then
			return 72
		else
			error("Unknown FontSize")
		end
	elseif font == Enum.Font.Arial or font == Enum.Font.ArialBold then
		if fontSize == Enum.FontSize.Size8 then
			return 8
		elseif fontSize == Enum.FontSize.Size9 then
			return 9
		elseif fontSize == Enum.FontSize.Size10 then
			return 10
		elseif fontSize == Enum.FontSize.Size11 then
			return 11
		elseif fontSize == Enum.FontSize.Size12 then
			return 12
		elseif fontSize == Enum.FontSize.Size14 then
			return 14
		elseif fontSize == Enum.FontSize.Size18 then
			return 18
		elseif fontSize == Enum.FontSize.Size24 then
			return 24
		elseif fontSize == Enum.FontSize.Size36 then
			return 36
		elseif fontSize == Enum.FontSize.Size48 then
			return 48
		else
			error("Unknown FontSize")
		end
	else
		error("Unknown Font " .. font)
	end
end

local function layoutGuiObjectsHelper(frame, guiObjects, settingsTable)
	local totalPixels = frame.AbsoluteSize.Y
	local pixelsRemaining = frame.AbsoluteSize.Y
	for i, child in ipairs(guiObjects) do
		if child:IsA("TextLabel") or child:IsA("TextButton") then
			local isLabel = child:IsA("TextLabel")
			if isLabel then
				pixelsRemaining = pixelsRemaining - settingsTable["TextLabelPositionPadY"]
			else
				pixelsRemaining = pixelsRemaining - settingsTable["TextButtonPositionPadY"]
			end
			child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
			child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, pixelsRemaining)

			if child.TextFits and child.TextBounds.Y < pixelsRemaining then
				child.Visible = true
				if isLabel then
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.TextBounds.Y + settingsTable["TextLabelSizePadY"])
				else 
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.TextBounds.Y + settingsTable["TextButtonSizePadY"])
				end

				while not child.TextFits do
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.AbsoluteSize.Y + 1)
				end
				pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y		

				if isLabel then
					pixelsRemaining = pixelsRemaining - settingsTable["TextLabelPositionPadY"]
				else
					pixelsRemaining = pixelsRemaining - settingsTable["TextButtonPositionPadY"]
				end
			else
				child.Visible = false
				pixelsRemaining = -1
			end			

		else
			--GuiObject
			child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
			pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y
			child.Visible = (pixelsRemaining >= 0)
		end
	end
end

RbxGuiLib.LayoutGuiObjects = function(frame, guiObjects, settingsTable)
	if not frame:IsA("GuiObject") then
		error("Frame must be a GuiObject")
	end
	for i, child in ipairs(guiObjects) do
		if not child:IsA("GuiObject") then
			error("All elements that are layed out must be of type GuiObject")
		end
	end

	if not settingsTable then
		settingsTable = {}
	end

	if not settingsTable["TextLabelSizePadY"] then
		settingsTable["TextLabelSizePadY"] = 0
	end
	if not settingsTable["TextLabelPositionPadY"] then
		settingsTable["TextLabelPositionPadY"] = 0
	end
	if not settingsTable["TextButtonSizePadY"] then
		settingsTable["TextButtonSizePadY"] = 12
	end
	if not settingsTable["TextButtonPositionPadY"] then
		settingsTable["TextButtonPositionPadY"] = 2
	end

	--Wrapper frame takes care of styled objects
	local wrapperFrame = Instance.new("Frame")
	wrapperFrame.Name = "WrapperFrame"
	wrapperFrame.BackgroundTransparency = 1
	wrapperFrame.Size = UDim2.new(1,0,1,0)
	wrapperFrame.Parent = frame

	for i, child in ipairs(guiObjects) do
		child.Parent = wrapperFrame
	end

	local recalculate = function()
		wait()
		layoutGuiObjectsHelper(wrapperFrame, guiObjects, settingsTable)
	end
	
	frame.Changed:connect(
		function(prop)
			if prop == "AbsoluteSize" then
				--Wait a heartbeat for it to sync in
				recalculate()
			end
		end)
	frame.AncestryChanged:connect(recalculate)

	layoutGuiObjectsHelper(wrapperFrame, guiObjects, settingsTable)
end


RbxGuiLib.CreateSlider = function(steps,width,position)
	local sliderGui = Instance.new("Frame")
	sliderGui.Size = UDim2.new(1,0,1,0)
	sliderGui.BackgroundTransparency = 1
	sliderGui.Name = "SliderGui"
	
	local areaSoak = Instance.new("TextButton")
	areaSoak.Name = "AreaSoak"
	areaSoak.Text = ""
	areaSoak.BackgroundTransparency = 1
	areaSoak.Active = false
	areaSoak.Size = UDim2.new(1,0,1,0)
	areaSoak.Visible = false
	areaSoak.ZIndex = 4
	areaSoak.Parent = sliderGui
	
	local sliderPosition = Instance.new("IntValue")
	sliderPosition.Name = "SliderPosition"
	sliderPosition.Value = 0
	sliderPosition.Parent = sliderGui
	
	local id = math.random(1,100)
	
	local bar = Instance.new("Frame")
	bar.Name = "Bar"
	bar.BackgroundColor3 = Color3.new(0,0,0)
	if type(width) == "number" then
		bar.Size = UDim2.new(0,width,0,5)
	else
		bar.Size = UDim2.new(0,200,0,5)
	end
	bar.BorderColor3 = Color3.new(95/255,95/255,95/255)
	bar.ZIndex = 2
	bar.Parent = sliderGui
	
	if position["X"] and position["X"]["Scale"] and position["X"]["Offset"] and position["Y"] and position["Y"]["Scale"] and position["Y"]["Offset"] then
		bar.Position = position
	end
	
	local slider = Instance.new("ImageButton")
	slider.Name = "Slider"
	slider.BackgroundTransparency = 1
	slider.Image = "rbxasset://textures/ui/Slider.png"
	slider.Position = UDim2.new(0,0,0.5,-10)
	slider.Size = UDim2.new(0,20,0,20)
	slider.ZIndex = 3
	slider.Parent = bar
	
	local areaSoakMouseMoveCon = nil
	
	areaSoak.MouseLeave:connect(function()
		if areaSoak.Visible then
			cancelSlide(areaSoak)
		end
	end)
	areaSoak.MouseButton1Up:connect(function()
		if areaSoak.Visible then
			cancelSlide(areaSoak)
		end
	end)
	
	slider.MouseButton1Down:connect(function()
		areaSoak.Visible = true
		if areaSoakMouseMoveCon then areaSoakMouseMoveCon:disconnect() end
		areaSoakMouseMoveCon = areaSoak.MouseMoved:connect(function(x,y)
			setSliderPos(x,slider,sliderPosition,bar,steps)
		end)
	end)
	
	slider.MouseButton1Up:connect(function() cancelSlide(areaSoak) end)
	
	sliderPosition.Changed:connect(function(prop)
		sliderPosition.Value = math.min(steps, math.max(1,sliderPosition.Value))
		local relativePosX = (sliderPosition.Value) / steps
		if relativePosX >= 1 then
			slider.Position = UDim2.new(relativePosX,-20,slider.Position.Y.Scale,slider.Position.Y.Offset)
		else
			slider.Position = UDim2.new(relativePosX,0,slider.Position.Y.Scale,slider.Position.Y.Offset)
		end
	end)
	
	return sliderGui, sliderPosition

end


RbxGuiLib.CreateScrollingFrame = function(orderList,scrollStyle)
	local frame = Instance.new("Frame")
	frame.Name = "ScrollingFrame"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(1,0,1,0)
	
	local scrollUpButton = Instance.new("ImageButton")
	scrollUpButton.Name = "ScrollUpButton"
	scrollUpButton.BackgroundTransparency = 1
	scrollUpButton.Image = "rbxasset://textures/ui/scrollbuttonUp.png"
	scrollUpButton.Size = UDim2.new(0,17,0,17) 

	
	local scrollDownButton = Instance.new("ImageButton")
	scrollDownButton.Name = "ScrollDownButton"
	scrollDownButton.BackgroundTransparency = 1
	scrollDownButton.Image = "rbxasset://textures/ui/scrollbuttonDown.png"
	scrollDownButton.Size = UDim2.new(0,17,0,17) 

	local style = "simple"
	if scrollStyle and tostring(scrollStyle) then
		style = scrollStyle
	end
	
	local scrollPosition = 1
	local rowSize = 1
	
	local layoutGridScrollBar = function()
		local guiObjects = {}
		if orderList then
			for i, child in ipairs(orderList) do
				if child.Parent == frame then
					table.insert(guiObjects, child)
				end
			end
		else
			local children = frame:GetChildren()
			if children then
				for i, child in ipairs(children) do 
					if child:IsA("GuiObject") then
						table.insert(guiObjects, child)
					end
				end
			end
		end
		if #guiObjects == 0 then
			scrollUpButton.Active = false
			scrollDownButton.Active = false
			scrollPosition = 1
			return
		end

		if scrollPosition > #guiObjects then
			scrollPosition = #guiObjects
		end
		
		local totalPixelsY = frame.AbsoluteSize.Y
		local pixelsRemainingY = frame.AbsoluteSize.Y
		
		local totalPixelsX  = frame.AbsoluteSize.X
		
		local xCounter = 0
		local rowSizeCounter = 0
		local setRowSize = true

		local pixelsBelowScrollbar = 0
		local pos = #guiObjects
		while pixelsBelowScrollbar < totalPixelsY and pos >= 1 do
			if pos >= scrollPosition then
				pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
			else
				xCounter = xCounter + guiObjects[pos].AbsoluteSize.X
				rowSizeCounter = rowSizeCounter + 1
				if xCounter >= totalPixelsX then
					if setRowSize then
						rowSize = rowSizeCounter - 1
						setRowSize = false
					end
					
					rowSizeCounter = 0
					xCounter = 0
					if pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y <= totalPixelsY then
						--It fits, so back up our scroll position
						pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
						if scrollPosition <= rowSize then
							scrollPosition = rowSize 
							break
						else
							--print("Backing up ScrollPosition from -- " ..scrollPosition)
							scrollPosition = scrollPosition - rowSize 
						end
					else
						break
					end
				end
			end
			pos = pos - 1
		end

		xCounter = 0
		--print("ScrollPosition = " .. scrollPosition)
		pos = scrollPosition
		rowSizeCounter = 0
		setRowSize = true
		local lastChildSize = 0
		
		local xOffset,yOffset = 0
		if guiObjects[1] then
			yOffset = math.ceil(math.floor(math.fmod(totalPixelsY,guiObjects[1].AbsoluteSize.X))/2)
			xOffset = math.ceil(math.floor(math.fmod(totalPixelsX,guiObjects[1].AbsoluteSize.Y))/2)
		end
		
		for i, child in ipairs(guiObjects) do
			if i < scrollPosition then
				--print("Hiding " .. child.Name)
				child.Visible = false
			else
				if pixelsRemainingY < 0 then
					--print("Out of Space " .. child.Name)
					child.Visible = false
				else
					--print("Laying out " .. child.Name)
					--GuiObject
					if setRowSize then rowSizeCounter = rowSizeCounter + 1 end
					if xCounter + child.AbsoluteSize.X >= totalPixelsX then
						if setRowSize then
							rowSize = rowSizeCounter - 1
							setRowSize = false
						end
						xCounter = 0
						pixelsRemainingY = pixelsRemainingY - child.AbsoluteSize.Y
					end
					child.Position = UDim2.new(child.Position.X.Scale,xCounter + xOffset, 0, totalPixelsY - pixelsRemainingY + yOffset)
					xCounter = xCounter + child.AbsoluteSize.X
					child.Visible = ((pixelsRemainingY - child.AbsoluteSize.Y) >= 0)
					lastChildSize = child.AbsoluteSize				
				end
			end
		end

		scrollUpButton.Active = (scrollPosition > 1)
		if lastChildSize == 0 then 
			scrollDownButton.Active = false
		else
			scrollDownButton.Active = ((pixelsRemainingY - lastChildSize.Y) < 0)
		end
	end


	local layoutSimpleScrollBar = function()
		local guiObjects = {}	
		
		if orderList then
			for i, child in ipairs(orderList) do
				if child.Parent == frame then
					table.insert(guiObjects, child)
				end
			end
		else
			local children = frame:GetChildren()
			if children then
				for i, child in ipairs(children) do 
					if child:IsA("GuiObject") then
						table.insert(guiObjects, child)
					end
				end
			end
		end
		if #guiObjects == 0 then
			scrollUpButton.Active = false
			scrollDownButton.Active = false
			scrollPosition = 1
			return
		end

		if scrollPosition > #guiObjects then
			scrollPosition = #guiObjects
		end
		
		local totalPixels = frame.AbsoluteSize.Y
		local pixelsRemaining = frame.AbsoluteSize.Y

		local pixelsBelowScrollbar = 0
		local pos = #guiObjects
		while pixelsBelowScrollbar < totalPixels and pos >= 1 do
			if pos >= scrollPosition then
				pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
			else
				if pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y <= totalPixels then
					--It fits, so back up our scroll position
					pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
					if scrollPosition <= 1 then
						scrollPosition = 1
						break
					else
						--print("Backing up ScrollPosition from -- " ..scrollPosition)
						scrollPosition = scrollPosition - 1
					end
				else
					break
				end
			end
			pos = pos - 1
		end

		--print("ScrollPosition = " .. scrollPosition)
		pos = scrollPosition
		for i, child in ipairs(guiObjects) do
			if i < scrollPosition then
				--print("Hiding " .. child.Name)
				child.Visible = false
			else
				if pixelsRemaining < 0 then
					--print("Out of Space " .. child.Name)
					child.Visible = false
				else
					--print("Laying out " .. child.Name)
					--GuiObject
					child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
					pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y
					child.Visible = (pixelsRemaining >= 0)				
				end
			end
		end
		scrollUpButton.Active = (scrollPosition > 1)
		scrollDownButton.Active = (pixelsRemaining < 0)
	end

	local reentrancyGuard = false
	local recalculate = function()
		if reentrancyGuard then
			return
		end
		reentrancyGuard = true
		wait()
		local success, err = nil
		if style == "grid" then
			success, err = pcall(function() layoutGridScrollBar(frame) end)
		elseif style == "simple" then
			success, err = pcall(function() layoutSimpleScrollBar(frame) end)
		end
		if not success then print(err) end

		reentrancyGuard = false
	end

	local scrollUp = function()
		if scrollUpButton.Active then
			scrollPosition = scrollPosition - rowSize
			recalculate()
		end
	end

	local scrollDown = function()
		if scrollDownButton.Active then
			scrollPosition = scrollPosition + rowSize
			recalculate()
		end
	end

	local scrollMouseCount = 0
	scrollUpButton.MouseButton1Click:connect(
		function()
			--print("Up-MouseButton1Click")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollUpButton.MouseLeave:connect(
		function()
			--print("Up-Leave")
			scrollMouseCount = scrollMouseCount + 1
		end)

	scrollUpButton.MouseButton1Down:connect(
		function()
			--print("Up-Down")
			scrollMouseCount = scrollMouseCount + 1

			scrollUp()
			local val = scrollMouseCount
			wait(0.5)
			while val == scrollMouseCount do
				if scrollUp() == false then
					break
				end
				wait(0.1)
			end				
		end)

	scrollDownButton.MouseButton1Click:connect(
		function()
			--print("Down-Click")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollDownButton.MouseLeave:connect(
		function()
			--print("Down-Leave")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollDownButton.MouseButton1Down:connect(
		function()
			--print("Down-Down")
			scrollMouseCount = scrollMouseCount + 1

			scrollDown()
			local val = scrollMouseCount
			wait(0.5)
			while val == scrollMouseCount do
				if scrollDown() == false then
					break
				end
				wait(0.1)
			end				
		end)


	frame.ChildAdded:connect(function()
		recalculate()
	end)

	frame.ChildRemoved:connect(function()
		recalculate()
	end)
	
	frame.Changed:connect(
		function(prop)
			if prop == "AbsoluteSize" then
				--Wait a heartbeat for it to sync in
				recalculate()
			end
		end)
	frame.AncestryChanged:connect(recalculate)

	return frame, scrollUpButton, scrollDownButton, recalculate
end
local function binaryGrow(min, max, fits)
	if min > max then
		return min
	end
	local biggestLegal = min

	while min <= max do
		local mid = min + math.floor((max - min) / 2)
		if fits(mid) and (biggestLegal == nil or biggestLegal < mid) then
			biggestLegal = mid
			
			--Try growing
			min = mid + 1
		else
			--Doesn't fit, shrink
			max = mid - 1
		end
	end
	return biggestLegal
end


local function binaryShrink(min, max, fits)
	if min > max then
		return min
	end
	local smallestLegal = max

	while min <= max do
		local mid = min + math.floor((max - min) / 2)
		if fits(mid) and (smallestLegal == nil or smallestLegal > mid) then
			smallestLegal = mid
			
			--It fits, shrink
			max = mid - 1			
		else
			--Doesn't fit, grow
			min = mid + 1
		end
	end
	return smallestLegal
end


local function getGuiOwner(instance)
	while instance ~= nil do
		if instance:IsA("ScreenGui") or instance:IsA("BillboardGui")  then
			return instance
		end
		instance = instance.Parent
	end
	return nil
end

RbxGuiLib.AutoTruncateTextObject = function(textLabel)
	local text = textLabel.Text

	local fullLabel = textLabel:Clone()
	fullLabel.Name = "Full" .. textLabel.Name 
	fullLabel.BorderSizePixel = 0
	fullLabel.BackgroundTransparency = 0
	fullLabel.Text = text
	fullLabel.TextXAlignment = Enum.TextXAlignment.Center
	fullLabel.Position = UDim2.new(0,-3,0,0)
	fullLabel.Size = UDim2.new(0,100,1,0)
	fullLabel.Visible = false
	fullLabel.Parent = textLabel

	local shortText = nil
	local mouseEnterConnection = nil
	local mouseLeaveConnection= nil

	local checkForResize = function()
		if getGuiOwner(textLabel) == nil then
			return
		end
		textLabel.Text = text
		if textLabel.TextFits then 
			--Tear down the rollover if it is active
			if mouseEnterConnection then
				mouseEnterConnection:disconnect()
				mouseEnterConnection = nil
			end
			if mouseLeaveConnection then
				mouseLeaveConnection:disconnect()
				mouseLeaveConnection = nil
			end
		else
			local len = string.len(text)
			textLabel.Text = text .. "~"

			--Shrink the text
			local textSize = binaryGrow(0, len, 
				function(pos)
					if pos == 0 then
						textLabel.Text = "~"
					else
						textLabel.Text = string.sub(text, 1, pos) .. "~"
					end
					return textLabel.TextFits
				end)
			shortText = string.sub(text, 1, textSize) .. "~"
			textLabel.Text = shortText
			
			--Make sure the fullLabel fits
			if not fullLabel.TextFits then
				--Already too small, grow it really bit to start
				fullLabel.Size = UDim2.new(0, 10000, 1, 0)
			end
			
			--Okay, now try to binary shrink it back down
			local fullLabelSize = binaryShrink(textLabel.AbsoluteSize.X,fullLabel.AbsoluteSize.X, 
				function(size)
					fullLabel.Size = UDim2.new(0, size, 1, 0)
					return fullLabel.TextFits
				end)
			fullLabel.Size = UDim2.new(0,fullLabelSize+6,1,0)

			--Now setup the rollover effects, if they are currently off
			if mouseEnterConnection == nil then
				mouseEnterConnection = textLabel.MouseEnter:connect(
					function()
						fullLabel.ZIndex = textLabel.ZIndex + 1
						fullLabel.Visible = true
						--textLabel.Text = ""
					end)
			end
			if mouseLeaveConnection == nil then
				mouseLeaveConnection = textLabel.MouseLeave:connect(
					function()
						fullLabel.Visible = false
						--textLabel.Text = shortText
					end)
			end
		end
	end
	textLabel.AncestryChanged:connect(checkForResize)
	textLabel.Changed:connect(
		function(prop) 
			if prop == "AbsoluteSize" then 
				checkForResize() 	
			end 
		end)

	checkForResize()

	local function changeText(newText)
		text = newText
		fullLabel.Text = text
		checkForResize()
	end

	return textLabel, changeText
end

local function TransitionTutorialPages(fromPage, toPage, transitionFrame, currentPageValue)	
	if fromPage then
		fromPage.Visible = false
		if transitionFrame.Visible == false then
			transitionFrame.Size = fromPage.Size
			transitionFrame.Position = fromPage.Position
		end
	else
		if transitionFrame.Visible == false then
			transitionFrame.Size = UDim2.new(0.0,50,0.0,50)
			transitionFrame.Position = UDim2.new(0.5,-25,0.5,-25)
		end
	end
	transitionFrame.Visible = true
	currentPageValue.Value = nil

	local newsize, newPosition
	if toPage then
		--Make it visible so it resizes
		toPage.Visible = true

		newSize = toPage.Size
		newPosition = toPage.Position

		toPage.Visible = false
	else
		newSize = UDim2.new(0.0,50,0.0,50)
		newPosition = UDim2.new(0.5,-25,0.5,-25)
	end
	transitionFrame:TweenSizeAndPosition(newSize, newPosition, Enum.EasingDirection.InOut, Enum.EasingStyle.Quad, 0.3, true,
		function(state)
			if state == Enum.TweenStatus.Completed then
				transitionFrame.Visible = false
				if toPage then
					toPage.Visible = true
					currentPageValue.Value = toPage
				end
			end
		end)
end

RbxGuiLib.CreateTutorial = function(name, tutorialKey, createButtons)
	local frame = Instance.new("Frame")
	frame.Name = "Tutorial-" .. name
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(0.6, 0, 0.6, 0)
	frame.Position = UDim2.new(0.2, 0, 0.2, 0)

	local transitionFrame = Instance.new("Frame")
	transitionFrame.Name = "TransitionFrame"
	transitionFrame.Style = Enum.FrameStyle.RobloxRound
	transitionFrame.Size = UDim2.new(0.6, 0, 0.6, 0)
	transitionFrame.Position = UDim2.new(0.2, 0, 0.2, 0)
	transitionFrame.Visible = false
	transitionFrame.Parent = frame

	local currentPageValue = Instance.new("ObjectValue")
	currentPageValue.Name = "CurrentTutorialPage"
	currentPageValue.Value = nil
	currentPageValue.Parent = frame

	local boolValue = Instance.new("BoolValue")
	boolValue.Name = "Buttons"
	boolValue.Value = createButtons
	boolValue.Parent = frame

	local pages = Instance.new("Frame")
	pages.Name = "Pages"
	pages.BackgroundTransparency = 1
	pages.Size = UDim2.new(1,0,1,0)
	pages.Parent = frame

	local function getVisiblePageAndHideOthers()
		local visiblePage = nil
		local children = pages:GetChildren()
		if children then
			for i,child in ipairs(children) do
				if child.Visible then
					if visiblePage then
						child.Visible = false
					else
						visiblePage = child
					end
				end
			end
		end
		return visiblePage
	end

	local showTutorial = function(alwaysShow)
		if alwaysShow or UserSettings().GameSettings:GetTutorialState(tutorialKey) == false then
			print("Showing tutorial-",tutorialKey)
			local currentTutorialPage = getVisiblePageAndHideOthers()

			local firstPage = pages:FindFirstChild("TutorialPage1")
			if firstPage then
				TransitionTutorialPages(currentTutorialPage, firstPage, transitionFrame, currentPageValue)	
			else
				error("Could not find TutorialPage1")
			end
		end
	end

	local dismissTutorial = function()
		local currentTutorialPage = getVisiblePageAndHideOthers()

		if currentTutorialPage then
			TransitionTutorialPages(currentTutorialPage, nil, transitionFrame, currentPageValue)
		end

		UserSettings().GameSettings:SetTutorialState(tutorialKey, true)
	end

	local gotoPage = function(pageNum)
		local page = pages:FindFirstChild("TutorialPage" .. pageNum)
		local currentTutorialPage = getVisiblePageAndHideOthers()
		TransitionTutorialPages(currentTutorialPage, page, transitionFrame, currentPageValue)
	end

	return frame, showTutorial, dismissTutorial, gotoPage
end 

local function CreateBasicTutorialPage(name, handleResize, skipTutorial)
	local frame = Instance.new("Frame")
	frame.Name = "TutorialPage"
	frame.Style = Enum.FrameStyle.RobloxRound
	frame.Size = UDim2.new(0.6, 0, 0.6, 0)
	frame.Position = UDim2.new(0.2, 0, 0.2, 0)
	frame.Visible = false
	
	local frameHeader = Instance.new("TextLabel")
	frameHeader.Name = "Header"
	frameHeader.Text = name
	frameHeader.BackgroundTransparency = 1
	frameHeader.FontSize = Enum.FontSize.Size24
	frameHeader.Font = Enum.Font.ArialBold
	frameHeader.TextColor3 = Color3.new(1,1,1)
	frameHeader.TextXAlignment = Enum.TextXAlignment.Center
	frameHeader.TextWrap = true
	frameHeader.Size = UDim2.new(1,-55, 0, 22)
	frameHeader.Position = UDim2.new(0,0,0,0)
	frameHeader.Parent = frame

	local skipButton = Instance.new("ImageButton")
	skipButton.Name = "SkipButton"
	skipButton.AutoButtonColor = false
	skipButton.BackgroundTransparency = 1
	skipButton.Image = "rbxasset://textures/ui/Skip.png"	
	skipButton.MouseButton1Click:connect(function()
		skipButton.Image = "rbxasset://textures/ui/Skip.png"	
		skipTutorial()
	end)
	skipButton.MouseEnter:connect(function()
		skipButton.Image = "rbxasset://textures/ui/SkipEnter.png"	
	end)
	skipButton.MouseLeave:connect(function()
		skipButton.Image = "rbxasset://textures/ui/Skip.png"	
	end)
	skipButton.Size = UDim2.new(0, 55, 0, 22)
	skipButton.Position = UDim2.new(1, -55, 0, 0)
	skipButton.Parent = frame

	local innerFrame = Instance.new("Frame")
	innerFrame.Name = "ContentFrame"
	innerFrame.BackgroundTransparency = 1
	innerFrame.Position = UDim2.new(0,0,0,22)
	innerFrame.Parent = frame

	local nextButton = Instance.new("TextButton")
	nextButton.Name = "NextButton"
	nextButton.Text = "Next"
	nextButton.TextColor3 = Color3.new(1,1,1)
	nextButton.Font = Enum.Font.Arial
	nextButton.FontSize = Enum.FontSize.Size18
	nextButton.Style = Enum.ButtonStyle.RobloxButtonDefault
	nextButton.Size = UDim2.new(0,80, 0, 32)
	nextButton.Position = UDim2.new(0.5, 5, 1, -32)
	nextButton.Active = false
	nextButton.Visible = false
	nextButton.Parent = frame

	local prevButton = Instance.new("TextButton")
	prevButton.Name = "PrevButton"
	prevButton.Text = "Previous"
	prevButton.TextColor3 = Color3.new(1,1,1)
	prevButton.Font = Enum.Font.Arial
	prevButton.FontSize = Enum.FontSize.Size18
	prevButton.Style = Enum.ButtonStyle.RobloxButton
	prevButton.Size = UDim2.new(0,80, 0, 32)
	prevButton.Position = UDim2.new(0.5, -85, 1, -32)
	prevButton.Active = false
	prevButton.Visible = false
	prevButton.Parent = frame

	innerFrame.Size = UDim2.new(1,0,1,-22-35)

	local parentConnection = nil

	local function basicHandleResize()
		if frame.Visible and frame.Parent then
			local maxSize = math.min(frame.Parent.AbsoluteSize.X, frame.Parent.AbsoluteSize.Y)
			handleResize(200,maxSize)
		end
	end

	frame.Changed:connect(
		function(prop)
			if prop == "Parent" then
				if parentConnection ~= nil then
					parentConnection:disconnect()
					parentConnection = nil
				end
				if frame.Parent and frame.Parent:IsA("GuiObject") then
					parentConnection = frame.Parent.Changed:connect(
						function(parentProp)
							if parentProp == "AbsoluteSize" then
								wait()
								basicHandleResize()
							end
						end)
					basicHandleResize()
				end
			end

			if prop == "Visible" then 
				basicHandleResize()
			end
		end)

	return frame, innerFrame
end

RbxGuiLib.CreateTextTutorialPage = function(name, text, skipTutorialFunc)
	local frame = nil
	local contentFrame = nil

	local textLabel = Instance.new("TextLabel")
	textLabel.BackgroundTransparency = 1
	textLabel.TextColor3 = Color3.new(1,1,1)
	textLabel.Text = text
	textLabel.TextWrap = true
	textLabel.TextXAlignment = Enum.TextXAlignment.Left
	textLabel.TextYAlignment = Enum.TextYAlignment.Center
	textLabel.Font = Enum.Font.Arial
	textLabel.FontSize = Enum.FontSize.Size14
	textLabel.Size = UDim2.new(1,0,1,0)

	local function handleResize(minSize, maxSize)
		size = binaryShrink(minSize, maxSize,
			function(size)
				frame.Size = UDim2.new(0, size, 0, size)
				return textLabel.TextFits
			end)
		frame.Size = UDim2.new(0, size, 0, size)
		frame.Position = UDim2.new(0.5, -size/2, 0.5, -size/2)
	end

	frame, contentFrame = CreateBasicTutorialPage(name, handleResize, skipTutorialFunc)
	textLabel.Parent = contentFrame

	return frame
end

RbxGuiLib.CreateImageTutorialPage = function(name, imageAsset, x, y, skipTutorialFunc)
	local frame = nil
	local contentFrame = nil

	local imageLabel = Instance.new("ImageLabel")
	imageLabel.BackgroundTransparency = 1
	imageLabel.Image = imageAsset
	imageLabel.Size = UDim2.new(0,x,0,y)
	imageLabel.Position = UDim2.new(0.5,-x/2,0.5,-y/2)

	local function handleResize(minSize, maxSize)
		size = binaryShrink(minSize, maxSize,
			function(size)
				return size >= x and size >= y
			end)
		if size >= x and size >= y then
			imageLabel.Size = UDim2.new(0,x, 0,y)
			imageLabel.Position = UDim2.new(0.5,-x/2, 0.5, -y/2)
		else
			if x > y then
				--X is limiter, so 
				imageLabel.Size = UDim2.new(1,0,y/x,0)
				imageLabel.Position = UDim2.new(0,0, 0.5 - (y/x)/2, 0)
			else
				--Y is limiter
				imageLabel.Size = UDim2.new(x/y,0,1, 0)
				imageLabel.Position = UDim2.new(0.5-(x/y)/2, 0, 0, 0)
			end
		end
		frame.Size = UDim2.new(0, size, 0, size)
		frame.Position = UDim2.new(0.5, -size/2, 0.5, -size/2)
	end

	frame, contentFrame = CreateBasicTutorialPage(name, handleResize, skipTutorialFunc)
	imageLabel.Parent = contentFrame

	return frame
end

RbxGuiLib.AddTutorialPage = function(tutorial, tutorialPage)
	local transitionFrame = tutorial.TransitionFrame
	local currentPageValue = tutorial.CurrentTutorialPage

	if not tutorial.Buttons.Value then
		tutorialPage.ContentFrame.Size = UDim2.new(1,0,1,-22)
		tutorialPage.NextButton.Parent = nil
		tutorialPage.PrevButton.Parent = nil
	end

	local children = tutorial.Pages:GetChildren()
	if children and #children > 0 then
		tutorialPage.Name = "TutorialPage" .. (#children+1)
		local previousPage = children[#children]
		if not previousPage:IsA("GuiObject") then
			error("All elements under Pages must be GuiObjects")
		end

		if tutorial.Buttons.Value then
			if previousPage.NextButton.Active then
				error("NextButton already Active on previousPage, please only add pages with RbxGui.AddTutorialPage function")
			end
			previousPage.NextButton.MouseButton1Click:connect(
				function()
					TransitionTutorialPages(previousPage, tutorialPage, transitionFrame, currentPageValue)
				end)
			previousPage.NextButton.Active = true
			previousPage.NextButton.Visible = true

			if tutorialPage.PrevButton.Active then
				error("PrevButton already Active on tutorialPage, please only add pages with RbxGui.AddTutorialPage function")
			end
			tutorialPage.PrevButton.MouseButton1Click:connect(
				function()
					TransitionTutorialPages(tutorialPage, previousPage, transitionFrame, currentPageValue)
				end)
			tutorialPage.PrevButton.Active = true
			tutorialPage.PrevButton.Visible = true
		end

		tutorialPage.Parent = tutorial.Pages
	else
		--First child
		tutorialPage.Name = "TutorialPage1"
		tutorialPage.Parent = tutorial.Pages
	end
end 

RbxGuiLib.Help = 
	function(funcNameOrFunc) 
		--input argument can be a string or a function.  Should return a description (of arguments and expected side effects)
		if funcNameOrFunc == "CreatePropertyDropDownMenu" or funcNameOrFunc == RbxGuiLib.CreatePropertyDropDownMenu then
			return "Function CreatePropertyDropDownMenu.  " ..
				   "Arguments: (instance, propertyName, enumType).  " .. 
				   "Side effect: returns a container with a drop-down-box that is linked to the 'property' field of 'instance' which is of type 'enumType'" 
		end 
		if funcNameOrFunc == "CreateDropDownMenu" or funcNameOrFunc == RbxGuiLib.CreateDropDownMenu then
			return "Function CreateDropDownMenu.  " .. 
			       "Arguments: (items, onItemSelected).  " .. 
				   "Side effect: Returns 2 results, a container to the gui object and a 'updateSelection' function for external updating.  The container is a drop-down-box created around a list of items" 
		end 
		if funcNameOrFunc == "CreateMessageDialog" or funcNameOrFunc == RbxGuiLib.CreateMessageDialog then
			return "Function CreateMessageDialog.  " .. 
			       "Arguments: (title, message, buttons). " .. 
			       "Side effect: Returns a gui object of a message box with 'title' and 'message' as passed in.  'buttons' input is an array of Tables contains a 'Text' and 'Function' field for the text/callback of each button"
		end		
		if funcNameOrFunc == "CreateStyledMessageDialog" or funcNameOrFunc == RbxGuiLib.CreateStyledMessageDialog then
			return "Function CreateStyledMessageDialog.  " .. 
			       "Arguments: (title, message, style, buttons). " .. 
			       "Side effect: Returns a gui object of a message box with 'title' and 'message' as passed in.  'buttons' input is an array of Tables contains a 'Text' and 'Function' field for the text/callback of each button, 'style' is a string, either Error, Notify or Confirm"
		end
		if funcNameOrFunc == "GetFontHeight" or funcNameOrFunc == RbxGuiLib.GetFontHeight then
			return "Function GetFontHeight.  " .. 
			       "Arguments: (font, fontSize). " .. 
			       "Side effect: returns the size in pixels of the given font + fontSize"
		end
		if funcNameOrFunc == "LayoutGuiObjects" or funcNameOrFunc == RbxGuiLib.LayoutGuiObjects then
		
		end
		if funcNameOrFunc == "CreateScrollingFrame" or funcNameOrFunc == RbxGuiLib.CreateScrollingFrame then
			return "Function CreateScrollingFrame.  " .. 
			   "Arguments: (orderList, style) " .. 
			   "Side effect: returns 4 objects, (scrollFrame, scrollUpButton, scrollDownButton, recalculateFunction).  'scrollFrame' can be filled with GuiObjects.  It will lay them out and allow scrollUpButton/scrollDownButton to interact with them.  Orderlist is optional (and specifies the order to layout the children.  Without orderlist, it uses the children order. style is also optional, and allows for a 'grid' styling if style is passed 'grid' as a string.  recalculateFunction can be called when a relayout is needed (when orderList changes)"
		end
		if funcNameOrFunc == "AutoTruncateTextObject" or funcNameOrFunc == RbxGuiLib.AutoTruncateTextObject then
			return "Function AutoTruncateTextObject.  " .. 
			   "Arguments: (textLabel) " .. 
			   "Side effect: returns 2 objects, (textLabel, changeText).  The 'textLabel' input is modified to automatically truncate text (with ellipsis), if it gets too small to fit.  'changeText' is a function that can be used to change the text, it takes 1 string as an argument"
		end
		if funcNameOrFunc == "CreateSlider" or funcNameOrFunc == RbxGuiLib.CreateSlider then
			return "Function CreateSlider.  " ..
				"Arguments: (steps, width, position) " ..
				"Side effect: returns 2 objects, (sliderGui, sliderPosition).  The 'steps' argument specifies how many different positions the slider can hold along the bar.  'width' specifies in pixels how wide the bar should be (modifiable afterwards if desired). 'position' argument should be a UDim2 for slider positioning. 'sliderPosition' is an IntValue whose current .Value specifies the specific step the slider is currently on."
		end
	end
-- RBXGUI END --

delay(0, function()

if game.CoreGui.Version < 3 then return end -- peace out if we aren't using the right client

-- A couple of necessary functions
local function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end
local function waitForProperty(instance, property)
	while not instance[property] do
		instance.Changed:wait()
	end
end

waitForChild(game,"Players")
waitForProperty(game.Players,"LocalPlayer")
local player = game.Players.LocalPlayer

local RbxGui,msg = RbxGuiLib
if not RbxGui then print("could not find RbxGui!") return end

--- Begin Locals
waitForChild(game,"Players")

-- don't do anything if we are in an empty game
if #game.Players:GetChildren() < 1 then
	game.Players.ChildAdded:wait()
end

local tilde = "~"
local backquote = "`"
game:GetService("GuiService"):AddKey(tilde) -- register our keys
game:GetService("GuiService"):AddKey(backquote)

local player = game.Players.LocalPlayer

local backpack = game:GetService("CoreGui").RobloxGui:FindFirstChild("Backpack")
local screen = game:GetService("CoreGui").RobloxGui
local closeButton = backpack.Tabs.CloseButton

local openCloseDebounce = false

local backpackItems = {}

local buttons = {}

local debounce = false

local guiTweenSpeed = 1

local backpackOldStateVisible = false
local browsingMenu = false

local mouseEnterCons = {}
local mouseClickCons = {}

local characterChildAddedCon = nil
local characterChildRemovedCon = nil
local backpackAddCon = nil
local humanoidDiedCon = nil
local backpackButtonClickCon = nil
local guiServiceKeyPressCon = nil

waitForChild(player,"Backpack")
local playerBackpack = player.Backpack

waitForChild(backpack,"Gear")
waitForChild(backpack.Gear,"GearPreview")
local gearPreview = backpack.Gear.GearPreview

waitForChild(backpack.Gear,"GearGridScrollingArea")
local scroller = backpack.Gear.GearGridScrollingArea

waitForChild(backpack.Parent,"CurrentLoadout")
local currentLoadout = backpack.Parent.CurrentLoadout

waitForChild(backpack.Parent,"ControlFrame")
waitForChild(backpack.Parent.ControlFrame,"BackpackButton")
local backpackButton = backpack.Parent.ControlFrame.BackpackButton

waitForChild(backpack.Gear,"GearGrid")
waitForChild(backpack.Gear.GearGrid,"GearButton")
local gearButton = backpack.Gear.GearGrid.GearButton
local grid = backpack.Gear.GearGrid

waitForChild(backpack.Gear.GearGrid,"SearchFrame")
waitForChild(backpack.Gear.GearGrid.SearchFrame,"SearchBoxFrame")
waitForChild(backpack.Gear.GearGrid.SearchFrame.SearchBoxFrame,"SearchBox")
local searchBox = backpack.Gear.GearGrid.SearchFrame.SearchBoxFrame.SearchBox

waitForChild(backpack.Gear.GearGrid.SearchFrame,"SearchButton")
local searchButton = backpack.Gear.GearGrid.SearchFrame.SearchButton

waitForChild(backpack.Gear.GearGrid,"ResetFrame")
local resetFrame = backpack.Gear.GearGrid.ResetFrame

waitForChild(backpack.Gear.GearGrid.ResetFrame,"ResetButtonBorder")
local resetButton = backpack.Gear.GearGrid.ResetFrame.ResetButtonBorder

waitForChild(backpack,"SwapSlot")
local swapSlot = backpack.SwapSlot


-- creating scroll bar early as to make sure items get placed correctly
local scrollFrame, scrollUp, scrollDown, recalculateScroll = RbxGui.CreateScrollingFrame(nil,"grid")

scrollFrame.Position = UDim2.new(0,0,0,30)
scrollFrame.Size = UDim2.new(1,0,1,-30)
scrollFrame.Parent = backpack.Gear.GearGrid

local scrollBar = Instance.new("Frame")
scrollBar.Name = "ScrollBar"
scrollBar.BackgroundTransparency = 0.9
scrollBar.BackgroundColor3 = Color3.new(1,1,1)
scrollBar.BorderSizePixel = 0
scrollBar.Size = UDim2.new(0, 17, 1, -36)
scrollBar.Position = UDim2.new(0,0,0,18)
scrollBar.Parent = scroller

scrollDown.Position = UDim2.new(0,0,1,-17)

scrollUp.Parent = scroller
scrollDown.Parent = scroller

local scrollFrameLoadout, scrollUpLoadout, scrollDownLoadout, recalculateScrollLoadout = RbxGui.CreateScrollingFrame()

scrollFrameLoadout.Position = UDim2.new(0,0,0,0)
scrollFrameLoadout.Size = UDim2.new(1,0,1,0)
scrollFrameLoadout.Parent = backpack.Gear.GearLoadouts.LoadoutsList

local LoadoutButton = Instance.new("TextButton")
LoadoutButton.RobloxLocked = true
LoadoutButton.Name = "LoadoutButton"
LoadoutButton.Font = Enum.Font.ArialBold
LoadoutButton.FontSize = Enum.FontSize.Size14
LoadoutButton.Position = UDim2.new(0,0,0,0)
LoadoutButton.Size = UDim2.new(1,0,0,32)
LoadoutButton.Style = Enum.ButtonStyle.RobloxButton
LoadoutButton.Text = "Loadout #1"
LoadoutButton.TextColor3 = Color3.new(1,1,1)
LoadoutButton.Parent = scrollFrameLoadout

local LoadoutButtonTwo = LoadoutButton:clone()
LoadoutButtonTwo.Text = "Loadout #2"
LoadoutButtonTwo.Parent = scrollFrameLoadout

local LoadoutButtonThree = LoadoutButton:clone()
LoadoutButtonThree.Text = "Loadout #3"
LoadoutButtonThree.Parent = scrollFrameLoadout

local LoadoutButtonFour = LoadoutButton:clone()
LoadoutButtonFour.Text = "Loadout #4"
LoadoutButtonFour.Parent = scrollFrameLoadout

local scrollBarLoadout = Instance.new("Frame")
scrollBarLoadout.Name = "ScrollBarLoadout"
scrollBarLoadout.BackgroundTransparency = 0.9
scrollBarLoadout.BackgroundColor3 = Color3.new(1,1,1)
scrollBarLoadout.BorderSizePixel = 0
scrollBarLoadout.Size = UDim2.new(0, 17, 1, -36)
scrollBarLoadout.Position = UDim2.new(0,0,0,18)
scrollBarLoadout.Parent = backpack.Gear.GearLoadouts.GearLoadoutsScrollingArea

scrollDownLoadout.Position = UDim2.new(0,0,1,-17)

scrollUpLoadout.Parent = backpack.Gear.GearLoadouts.GearLoadoutsScrollingArea
scrollDownLoadout.Parent = backpack.Gear.GearLoadouts.GearLoadoutsScrollingArea


-- Begin Functions
function removeFromMap(map,object)
	for i = 1, #map do
		if map[i] == object then
			table.remove(map,i)
			break
		end
	end
end

function robloxLock(instance)
  instance.RobloxLocked = true
  children = instance:GetChildren()
  if children then
	 for i, child in ipairs(children) do
		robloxLock(child)
	 end
  end
end

function resize()
	local size = 0
	if gearPreview.AbsoluteSize.Y > gearPreview.AbsoluteSize.X then
		size = gearPreview.AbsoluteSize.X * 0.75
	else
		size = gearPreview.AbsoluteSize.Y * 0.75
	end

	gearPreview.GearImage.Size = UDim2.new(0,size,0,size)
	gearPreview.GearImage.Position = UDim2.new(0,gearPreview.AbsoluteSize.X/2 - size/2,0.75,-size)
	
	resizeGrid()
end

function addToGrid(child)
	if not child:IsA("Tool") then
		if not child:IsA("HopperBin") then 
			return
		end
	end
	if child:FindFirstChild("RobloxBuildTool") then return end
	
	for i,v in pairs(backpackItems) do  -- check to see if we already have this gear registered
		if v == child then return end
	end

	table.insert(backpackItems,child)
	
	local changeCon = child.Changed:connect(function(prop)
		if prop == "Name" then
			if buttons[child] then
				if buttons[child].Image == "" then
					buttons[child].GearText.Text = child.Name
				end
			end
		end
	end)
	local ancestryCon = nil
	ancestryCon = child.AncestryChanged:connect(function(theChild,theParent)
		local thisObject = nil
		for k,v in pairs(backpackItems) do
			if v == child then
				thisObject = v
				break
			end
		end
		
		waitForProperty(player,"Character")
		waitForChild(player,"Backpack")
		if (child.Parent ~= player.Backpack and child.Parent ~= player.Character) then
			if ancestryCon then ancestryCon:disconnect() end
			if changeCon then changeCon:disconnect() end
			
			for k,v in pairs(backpackItems) do
				if v == thisObject then
					if mouseEnterCons[buttons[v]] then mouseEnterCons[buttons[v]]:disconnect() end
					if mouseClickCons[buttons[v]] then mouseClickCons[buttons[v]]:disconnect() end
					buttons[v].Parent = nil
					buttons[v] = nil
					break
				end
			end

			removeFromMap(backpackItems,thisObject)
			
			resizeGrid()
		else
			resizeGrid()
		end
		updateGridActive()
	end)
	resizeGrid()
end

function buttonClick(button)
	if button:FindFirstChild("UnequipContextMenu") and not button.Active then
		button.UnequipContextMenu.Visible = true
		browsingMenu = true
	end
end

function previewGear(button)
	if not browsingMenu then
		gearPreview.GearImage.Image = button.Image
		gearPreview.GearStats.GearName.Text = button.GearReference.Value.Name
	end
end

function checkForSwap(button,x,y)
	local loadoutChildren = currentLoadout:GetChildren()
	for i = 1, #loadoutChildren do
		if loadoutChildren[i]:IsA("Frame") and string.find(loadoutChildren[i].Name,"Slot") then
			if x >= loadoutChildren[i].AbsolutePosition.x and x <= (loadoutChildren[i].AbsolutePosition.x + loadoutChildren[i].AbsoluteSize.x) then
				if y >= loadoutChildren[i].AbsolutePosition.y and y <= (loadoutChildren[i].AbsolutePosition.y + loadoutChildren[i].AbsoluteSize.y) then
					local slot = tonumber(string.sub(loadoutChildren[i].Name,5))
					swapGearSlot(slot,button)
					return true
				end
			end
		end
	end
	return false
end

function resizeGrid()
	for k,v in pairs(backpackItems) do
		if not v:FindFirstChild("RobloxBuildTool") then
			if not buttons[v] then
				local buttonClone = gearButton:clone()
				buttonClone.Parent = grid.ScrollingFrame
				buttonClone.Visible = true
				buttonClone.Image = v.TextureId
				if buttonClone.Image == "" then
					buttonClone.GearText.Text = v.Name
				end
				--print("v =",v)
				buttonClone.GearReference.Value = v
				buttonClone.Draggable = true 
				buttons[v] = buttonClone
				
				local unequipMenu = getGearContextMenu()
				
				unequipMenu.Visible = false
				unequipMenu.Parent = buttonClone
				
				local beginPos = nil
				buttonClone.DragBegin:connect(function(value)
					buttonClone.ZIndex = 9
					beginPos = value
				end)
				buttonClone.DragStopped:connect(function(x,y)
					if beginPos ~= buttonClone.Position then
						buttonClone.ZIndex = 1
						if not checkForSwap(buttonClone,x,y) then
							buttonClone:TweenPosition(beginPos,Enum.EasingDirection.Out, Enum.EasingStyle.Quad, 0.5, true)
							buttonClone.Draggable = false
							delay(0.5,function()
								buttonClone.Draggable = true
							end)
						else
							buttonClone.Position = beginPos
						end
					end	
				end)
				
				mouseEnterCons[buttonClone] = buttonClone.MouseEnter:connect(function() previewGear(buttonClone) end)
				mouseClickCons[buttonClone] = buttonClone.MouseButton1Click:connect(function() buttonClick(buttonClone) end)
			end
		end
	end
	recalculateScroll()
end

function showPartialGrid(subset)

	resetFrame.Visible = true

	for k,v in pairs(buttons) do
		v.Parent = nil
	end
	for k,v in pairs(subset) do
		v.Parent =  grid.ScrollingFrame
	end
	recalculateScroll()
end

function showEntireGrid()
	resetFrame.Visible = false
	
	for k,v in pairs(buttons) do
		v.Parent = grid.ScrollingFrame
	end
	recalculateScroll()
end

function inLoadout(gear)
	local children = currentLoadout:GetChildren()
	for i = 1, #children do
		if children[i]:IsA("Frame") then
			local button = children[i]:GetChildren()
			if #button > 0 then
				if button[1].GearReference.Value and button[1].GearReference.Value == gear then
					return true
				end
			end
		end
	end
	return false
end	

function updateGridActive()
	for k,v in pairs(backpackItems) do
		if buttons[v] then
			local gear = nil
			local gearRef = buttons[v]:FindFirstChild("GearReference")
			
			if gearRef then gear = gearRef.Value end
			
			if not gear then
				buttons[v].Active = false
			elseif inLoadout(gear) then
				buttons[v].Active = false
			else
				buttons[v].Active = true
			end
		end
	end
end

function centerGear(loadoutChildren)
	local gearButtons = {}
	local lastSlotAdd = nil
	for i = 1, #loadoutChildren do
		if loadoutChildren[i]:IsA("Frame") and #loadoutChildren[i]:GetChildren() > 0 then
			if loadoutChildren[i].Name == "Slot0" then 
				lastSlotAdd = loadoutChildren[i]
			else
				table.insert(gearButtons, loadoutChildren[i])
			end
		end
	end
	if lastSlotAdd then table.insert(gearButtons,lastSlotAdd) end
	
	local startPos = ( 1 - (#gearButtons * 0.1) ) / 2
	for i = 1, #gearButtons do	
		gearButtons[i]:TweenPosition(UDim2.new(startPos + ((i - 1) * 0.1),0,0,0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, 0.25, true)
	end
end

function spreadOutGear(loadoutChildren)
	for i = 1, #loadoutChildren do
		if loadoutChildren[i]:IsA("Frame") then
			local slot = tonumber(string.sub(loadoutChildren[i].Name,5))
			if slot == 0 then slot = 10 end
			loadoutChildren[i]:TweenPosition(UDim2.new((slot - 1)/10,0,0,0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, 0.25, true)
		end
	end
end

function openCloseBackpack()
	if openCloseDebounce then return end
	openCloseDebounce = true
	
	local visible = not backpack.Visible
	if visible then
		updateGridActive()
		local centerDialogSupported, msg = pcall(function() game.GuiService:AddCenterDialog(backpack, Enum.CenterDialogType.PlayerInitiatedDialog, 
			function()
				backpack.Visible = true
				loadoutChildren = currentLoadout:GetChildren()
				for i = 1, #loadoutChildren do
					if loadoutChildren[i]:IsA("Frame") then
						loadoutChildren[i].BackgroundTransparency = 0.5
					end
				end 
				spreadOutGear(loadoutChildren)
			end)
		end)
		backpackButton.Selected = true
		backpack:TweenSizeAndPosition(UDim2.new(0.55, 0, 0.6, 0),UDim2.new(0.225, 0, 0.2, 0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, guiTweenSpeed/2, true)
		delay(guiTweenSpeed/2 + 0.01,
			function()
				local children = backpack:GetChildren()
				for i = 1, #children do
					if children[i]:IsA("Frame") then
						children[i].Visible = true
					end
				end
				resizeGrid()
				resize()
				openCloseDebounce = false
			end)
	else
		backpackButton.Selected = false
		local children = backpack:GetChildren()
		for i = 1, #children do
			if children[i]:IsA("Frame") then
				children[i].Visible = false
			end
		end
		loadoutChildren = currentLoadout:GetChildren()
		for i = 1, #loadoutChildren do
			if loadoutChildren[i]:IsA("Frame") then
				loadoutChildren[i].BackgroundTransparency = 1
			end
		end
		centerGear(loadoutChildren)
	
		backpack:TweenSizeAndPosition(UDim2.new(0,0,0,0),UDim2.new(0.5,0,0.5,0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, guiTweenSpeed/2, true)
		delay(guiTweenSpeed/2 + 0.01,
			function()
				backpack.Visible = visible
				resizeGrid()
				resize()
				pcall(function() game.GuiService:RemoveCenterDialog(backpack) end)
				openCloseDebounce = false
			end)
	end
end

function loadoutCheck(child, selectState)
	if not child:IsA("ImageButton") then return end
	for k,v in pairs(backpackItems) do
		if buttons[v] then
			if child:FindFirstChild("GearReference") then
				if buttons[v].GearReference.Value == child.GearReference.Value then
					buttons[v].Active = selectState
					break
				end
			end
		end
	end
end

function clearPreview()
	gearPreview.GearImage.Image = ""
	gearPreview.GearStats.GearName.Text = ""
end

function removeAllEquippedGear(physGear)
	local stuff = player.Character:GetChildren()
	for i = 1, #stuff do
		if ( stuff[i]:IsA("Tool") or stuff[i]:IsA("HopperBin") ) and stuff[i] ~= physGear then
			stuff[i].Parent = playerBackpack
		end
	end
end

function equipGear(physGear)
	removeAllEquippedGear(physGear)
	physGear.Parent = player.Character
	updateGridActive()
end

function unequipGear(physGear)
	physGear.Parent = playerBackpack
	updateGridActive()
end

function highlight(button)
	button.TextColor3 = Color3.new(0,0,0)
	button.BackgroundColor3 = Color3.new(0.8,0.8,0.8)
end
function clearHighlight(button)
	button.TextColor3 = Color3.new(1,1,1)
	button.BackgroundColor3 = Color3.new(0,0,0)
end

function swapGearSlot(slot,gearButton)
	if not swapSlot.Value then -- signal loadout to swap a gear out
		swapSlot.Slot.Value = slot
		swapSlot.GearButton.Value = gearButton
		swapSlot.Value = true
		updateGridActive()
	end
end


local UnequipGearMenuClick = function(element, menu)
	if type(element.Action) ~= "number" then return end
	local num = element.Action
	if num == 1 then -- remove from loadout
		unequipGear(menu.Parent.GearReference.Value)
		local inventoryButton = menu.Parent
		local gearToUnequip = inventoryButton.GearReference.Value
		local loadoutChildren = currentLoadout:GetChildren()
		local slot = -1
		for i = 1, #loadoutChildren do
			if loadoutChildren[i]:IsA("Frame") then
				local button = loadoutChildren[i]:GetChildren()
				if button[1] and button[1].GearReference.Value == gearToUnequip then
					slot = button[1].SlotNumber.Text
					break
				end
			end
		end
		swapGearSlot(slot,nil)
	end
end

-- these next two functions are used to stop any use of backpack while the player is dead (can cause issues)
function activateBackpack()
	backpack.Visible = backpackOldStateVisible
	
	backpackButtonClickCon = backpackButton.MouseButton1Click:connect(function() openCloseBackpack() end)
	guiServiceKeyPressCon = game:GetService("GuiService").KeyPressed:connect(function(key)
		if key == tilde or key == backquote then
			openCloseBackpack()
		end
	end)
end
function deactivateBackpack()
	if backpackButtonClickCon then backpackButtonClickCon:disconnect() end
	if guiServiceKeyPressCon then guiServiceKeyPressCon:disconnect() end

	backpackOldStateVisible = backpack.Visible
	backpack.Visible = false
end

function setupCharacterConnections()

	if backpackAddCon then backpackAddCon:disconnect() end
	backpackAddCon = game.Players.LocalPlayer.Backpack.ChildAdded:connect(function(child) addToGrid(child) end)
	
	-- make sure we get all the children
	local backpackChildren = game.Players.LocalPlayer.Backpack:GetChildren()
	for i = 1, #backpackChildren do
		addToGrid(backpackChildren[i])
	end

	if characterChildAddedCon then characterChildAddedCon:disconnect() end
	characterChildAddedCon = 
		game.Players.LocalPlayer.Character.ChildAdded:connect(function(child)
			addToGrid(child)
			updateGridActive()
		end)
		
	if characterChildRemovedCon then characterChildRemovedCon:disconnect() end
	characterChildRemovedCon = 
		game.Players.LocalPlayer.Character.ChildRemoved:connect(function(child)
			updateGridActive()
		end)
		
			
	if humanoidDiedCon then humanoidDiedCon:disconnect() end
	local localPlayer = game.Players.LocalPlayer
	waitForProperty(localPlayer,"Character")
	waitForChild(localPlayer.Character,"Humanoid")
	humanoidDiedCon = game.Players.LocalPlayer.Character.Humanoid.Died:connect(function() deactivateBackpack() end)
	
	activateBackpack()
end

function removeCharacterConnections()
	if characterChildAddedCon then characterChildAddedCon:disconnect() end
	if characterChildRemovedCon then characterChildRemovedCon:disconnect() end
	if backpackAddCon then backpackAddCon:disconnect() end
end

function trim(s)
  return (s:gsub("^%s*(.-)%s*$", "%1"))
end

function splitByWhiteSpace(text)
	if type(text) ~= "string" then return nil end
	
	local terms = {}
	for token in string.gmatch(text, "[^%s]+") do
	   if string.len(token) > 2 then
			table.insert(terms,token)
	   end
	end
	return terms
end

function filterGear(searchTerm)
	string.lower(searchTerm)
	searchTerm = trim(searchTerm)
	if string.len(searchTerm) < 2 then return nil end
	local terms = splitByWhiteSpace(searchTerm)
	
	local filteredGear = {}
	for k,v in pairs(backpackItems) do
		if buttons[v] then
			local gearString = string.lower(buttons[v].GearReference.Value.Name)
			gearString = trim(gearString)
			for i = 1, #terms do
				if string.match(gearString,terms[i]) then
					table.insert(filteredGear,buttons[v])
					break
				end
			end
		end
	end
	
	return filteredGear
end


function showSearchGear()
	local searchText = searchBox.Text
	searchBox.Text = "Search..."
	local filteredButtons = filterGear(searchText)
	if filteredButtons and #filteredButtons > 0 then
		showPartialGrid(filteredButtons)
	else
		showEntireGrid()
	end
end

function nukeBackpack()
	while #buttons > 0 do
		table.remove(buttons)
	end
	buttons = {}
	while #backpackItems > 0 do
		table.remove(backpackItems)
	end
	backpackItems = {}
	local scrollingFrameChildren = grid.ScrollingFrame:GetChildren()
	for i = 1, #scrollingFrameChildren do
		scrollingFrameChildren[i]:remove()
	end
end

function getGearContextMenu()
	local gearContextMenu = Instance.new("Frame")
	gearContextMenu.Active = true
	gearContextMenu.Name = "UnequipContextMenu"
	gearContextMenu.Size = UDim2.new(0,115,0,70)
	gearContextMenu.Position = UDim2.new(0,-16,0,-16)
	gearContextMenu.BackgroundTransparency = 1
	gearContextMenu.Visible = false

	local gearContextMenuButton = Instance.new("TextButton")
	gearContextMenuButton.Name = "UnequipContextMenuButton"
	gearContextMenuButton.Text = ""
	gearContextMenuButton.Style = Enum.ButtonStyle.RobloxButtonDefault
	gearContextMenuButton.ZIndex = 4
	gearContextMenuButton.Size = UDim2.new(1, 0, 1, -20)
	gearContextMenuButton.Visible = true
	gearContextMenuButton.Parent = gearContextMenu
	
	local elementHeight = 12
	
	local contextMenuElements = {}		
	local contextMenuElementsName = {"Remove Hotkey"}

	for i = 1, #contextMenuElementsName do
		local element = {}
		element.Type = "Button"
		element.Text = contextMenuElementsName[i]
		element.Action = i
		element.DoIt = UnequipGearMenuClick
		table.insert(contextMenuElements,element)
	end

	for i, contextElement in ipairs(contextMenuElements) do
		local element = contextElement
		if element.Type == "Button" then
			local button = Instance.new("TextButton")
			button.Name = "UnequipContextButton" .. i
			button.BackgroundColor3 = Color3.new(0,0,0)
			button.BorderSizePixel = 0
			button.TextXAlignment = Enum.TextXAlignment.Left
			button.Text = " " .. contextElement.Text
			button.Font = Enum.Font.Arial
			button.FontSize = Enum.FontSize.Size14
			button.Size = UDim2.new(1, 8, 0, elementHeight)
			button.Position = UDim2.new(0,0,0,elementHeight * i)
			button.TextColor3 = Color3.new(1,1,1)
			button.ZIndex = 4
			button.Parent = gearContextMenuButton

			button.MouseButton1Click:connect(function()
				if button.Active and not gearContextMenu.Parent.Active then
					local success, result = pcall(function() element.DoIt(element, gearContextMenu) end)
					browsingMenu = false
					gearContextMenu.Visible = false
					clearHighlight(button)
					clearPreview()
				end
			end)
			
			button.MouseEnter:connect(function()
				if button.Active and gearContextMenu.Parent.Active then
					highlight(button)
				end
			end)
			button.MouseLeave:connect(function()
				if button.Active and gearContextMenu.Parent.Active then
					clearHighlight(button)
				end
			end)
			
			contextElement.Button = button
			contextElement.Element = button
		elseif element.Type == "Label" then
			local frame = Instance.new("Frame")
			frame.Name = "ContextLabel" .. i
			frame.BackgroundTransparency = 1
			frame.Size = UDim2.new(1, 8, 0, elementHeight)

			local label = Instance.new("TextLabel")	
			label.Name = "Text1"
			label.BackgroundTransparency = 1
			label.BackgroundColor3 = Color3.new(1,1,1)
			label.BorderSizePixel = 0
			label.TextXAlignment = Enum.TextXAlignment.Left
			label.Font = Enum.Font.ArialBold
			label.FontSize = Enum.FontSize.Size14
			label.Position = UDim2.new(0.0, 0, 0, 0)
			label.Size = UDim2.new(0.5, 0, 1, 0)
			label.TextColor3 = Color3.new(1,1,1)
			label.ZIndex = 4
			label.Parent = frame
			element.Label1 = label
		
			if element.GetText2 then
				label = Instance.new("TextLabel")	
				label.Name = "Text2"
				label.BackgroundTransparency = 1
				label.BackgroundColor3 = Color3.new(1,1,1)
				label.BorderSizePixel = 0
				label.TextXAlignment = Enum.TextXAlignment.Right
				label.Font = Enum.Font.Arial
				label.FontSize = Enum.FontSize.Size14
				label.Position = UDim2.new(0.5, 0, 0, 0)
				label.Size = UDim2.new(0.5, 0, 1, 0)
				label.TextColor3 = Color3.new(1,1,1)
				label.ZIndex = 4
				label.Parent = frame
				element.Label2 = label
			end
			frame.Parent = gearContextMenuButton
			element.Label = frame
			element.Element =  frame
		end
	end

	gearContextMenu.ZIndex = 4
	gearContextMenu.MouseLeave:connect(function()
		browsingMenu = false
		gearContextMenu.Visible = false
		clearPreview()
	end)
	robloxLock(gearContextMenu)
	
	return gearContextMenu
end

local backpackChildren = player.Backpack:GetChildren()
for i = 1, #backpackChildren do
	addToGrid(backpackChildren[i])
end

------------------------- Start Lifelong Connections -----------------------
screen.Changed:connect(function(prop)
	if prop == "AbsoluteSize" then
		if debounce then return end
		debounce = true
		wait()
		resize()
		resizeGrid()
		debounce = false
	end
end)

currentLoadout.ChildAdded:connect(function(child) loadoutCheck(child, false) end)
currentLoadout.ChildRemoved:connect(function(child) loadoutCheck(child, true) end)

currentLoadout.DescendantAdded:connect(function(descendant)
	if not backpack.Visible and ( descendant:IsA("ImageButton") or descendant:IsA("TextButton") ) then
		centerGear(currentLoadout:GetChildren())
	end
end)
currentLoadout.DescendantRemoving:connect(function(descendant)
	if not backpack.Visible and ( descendant:IsA("ImageButton") or descendant:IsA("TextButton") ) then
		wait()
		centerGear(currentLoadout:GetChildren())
	end
end)
	
grid.MouseEnter:connect(function() clearPreview() end)
grid.MouseLeave:connect(function() clearPreview() end)

player.CharacterRemoving:connect(function()
	removeCharacterConnections()
	nukeBackpack()
end)
player.CharacterAdded:connect(function() setupCharacterConnections() end)

player.ChildAdded:connect(function(child)
	if child:IsA("Backpack") then
		playerBackpack = child
		if backpackAddCon then backpackAddCon:disconnect() end
		backpackAddCon = game.Players.LocalPlayer.Backpack.ChildAdded:connect(function(child) addToGrid(child) end)
	end
end)

swapSlot.Changed:connect(function()
	if not swapSlot.Value then
		updateGridActive()
	end
end)

searchBox.FocusLost:connect(function(enterPressed)
	if enterPressed then
		showSearchGear()
	end
end)

local loadoutChildren = currentLoadout:GetChildren()
for i = 1, #loadoutChildren do
	if loadoutChildren[i]:IsA("Frame") and string.find(loadoutChildren[i].Name,"Slot") then
		loadoutChildren[i].ChildRemoved:connect(function()
			updateGridActive()
		end)
		loadoutChildren[i].ChildAdded:connect(function()
			updateGridActive()
		end)
	end
end

closeButton.MouseButton1Click:connect(function() openCloseBackpack() end)

searchButton.MouseButton1Click:connect(function() showSearchGear() end)
resetButton.MouseButton1Click:connect(function() showEntireGrid() end)
------------------------- End Lifelong Connections -----------------------

resize()
resizeGrid()

-- make sure any items in the loadout are accounted for in inventory
local loadoutChildren = currentLoadout:GetChildren()
for i = 1, #loadoutChildren do
	loadoutCheck(loadoutChildren[i], false)
end
if not backpack.Visible then centerGear(currentLoadout:GetChildren()) end

-- make sure that inventory is listening to gear reparenting
if characterChildAddedCon == nil and game.Players.LocalPlayer["Character"] then
	setupCharacterConnections()
end
if not backpackAddCon then
	backpackAddCon = game.Players.LocalPlayer.Backpack.ChildAdded:connect(function(child) addToGrid(child) end)
end

-- flip it on if we are good
if game.CoreGui.Version >= 3 then
	backpackButton.Visible = true
end

recalculateScrollLoadout()

end)

-- RBXGUI START --
local RbxGuiLib = {}

local function ScopedConnect(parentInstance, instance, event, signalFunc, syncFunc, removeFunc)
	local eventConnection = nil

	--Connection on parentInstance is scoped by parentInstance (when destroyed, it goes away)
	local tryConnect = function()
		if game:IsAncestorOf(parentInstance) then
			--Entering the world, make sure we are connected/synced
			if not eventConnection then
				eventConnection = instance[event]:connect(signalFunc)
				if syncFunc then syncFunc() end
			end
		else
			--Probably leaving the world, so disconnect for now
			if eventConnection then
				eventConnection:disconnect()
				if removeFunc then removeFunc() end
			end
		end
	end

	--Hook it up to ancestryChanged signal
	local connection = parentInstance.AncestryChanged:connect(tryConnect)
	
	--Now connect us if we're already in the world
	tryConnect()
	
	return connection
end

local function CreateButtons(frame, buttons, yPos, ySize)
	local buttonNum = 1
	local buttonObjs = {}
	for i, obj in ipairs(buttons) do 
		local button = Instance.new("TextButton")
		button.Name = "Button" .. buttonNum
		button.Font = Enum.Font.Arial
		button.FontSize = Enum.FontSize.Size18
		button.AutoButtonColor = true
		button.Style = Enum.ButtonStyle.RobloxButtonDefault 
		button.Text = obj.Text
		button.TextColor3 = Color3.new(1,1,1)
		button.MouseButton1Click:connect(obj.Function)
		button.Parent = frame
		buttonObjs[buttonNum] = button

		buttonNum = buttonNum + 1
	end
	local numButtons = buttonNum-1

	if numButtons == 1 then
		frame.Button1.Position = UDim2.new(0.35, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.4,0,ySize.Scale, ySize.Offset)
	elseif numButtons == 2 then
		frame.Button1.Position = UDim2.new(0.1, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.8/3,0, ySize.Scale, ySize.Offset)

		frame.Button2.Position = UDim2.new(0.55, 0, yPos.Scale, yPos.Offset)
		frame.Button2.Size = UDim2.new(.35,0, ySize.Scale, ySize.Offset)
	elseif numButtons >= 3 then
		local spacing = .1 / numButtons
		local buttonSize = .9 / numButtons

		buttonNum = 1
		while buttonNum <= numButtons do
			buttonObjs[buttonNum].Position = UDim2.new(spacing*buttonNum + (buttonNum-1) * buttonSize, 0, yPos.Scale, yPos.Offset)
			buttonObjs[buttonNum].Size = UDim2.new(buttonSize, 0, ySize.Scale, ySize.Offset)
			buttonNum = buttonNum + 1
		end
	end
end

local function setSliderPos(newAbsPosX,slider,sliderPosition,bar,steps)

	local newStep = steps - 1 --otherwise we really get one more step than we want
	
	local relativePosX = math.min(1, math.max(0, (newAbsPosX - bar.AbsolutePosition.X) / bar.AbsoluteSize.X ) )
	local wholeNum, remainder = math.modf(relativePosX * newStep)
	if remainder > 0.5 then
		wholeNum = wholeNum + 1
	end
	relativePosX = wholeNum/newStep

	local result = math.ceil(relativePosX * newStep)
	if sliderPosition.Value ~= (result + 1) then --onky update if we moved a step
		sliderPosition.Value = result + 1
		
		if relativePosX == 1 then
			slider.Position = UDim2.new(1,-slider.AbsoluteSize.X,slider.Position.Y.Scale,slider.Position.Y.Offset)
		else
			slider.Position = UDim2.new(relativePosX,0,slider.Position.Y.Scale,slider.Position.Y.Offset)
		end
	end
	
end

local function cancelSlide(areaSoak)
	areaSoak.Visible = false
	if areaSoakMouseMoveCon then areaSoakMouseMoveCon:disconnect() end
end

RbxGuiLib.CreateStyledMessageDialog = function(title, message, style, buttons)
	local frame = Instance.new("Frame")
	frame.Size = UDim2.new(0.5, 0, 0, 165)
	frame.Position = UDim2.new(0.25, 0, 0.5, -72.5)
	frame.Name = "MessageDialog"
	frame.Active = true
	frame.Style = Enum.FrameStyle.RobloxRound	
	
	local styleImage = Instance.new("ImageLabel")
	styleImage.Name = "StyleImage"
	styleImage.BackgroundTransparency = 1
	styleImage.Position = UDim2.new(0,5,0,15)
	if style == "error" or style == "Error" then
		styleImage.Size = UDim2.new(0, 71, 0, 71)
		styleImage.Image = "rbxasset://textures/ui/Error.png"
	elseif style == "notify" or style == "Notify" then
		styleImage.Size = UDim2.new(0, 71, 0, 71)
		styleImage.Image = "rbxasset://textures/ui/Notify.png"
	elseif style == "confirm" or style == "Confirm" then
		styleImage.Size = UDim2.new(0, 74, 0, 76)
		styleImage.Image = "rbxasset://textures/ui/Confirm.png"
	else
		return RbxGuiLib.CreateMessageDialog(title,message,buttons)
	end
	styleImage.Parent = frame
	
	local titleLabel = Instance.new("TextLabel")
	titleLabel.Name = "Title"
	titleLabel.Text = title
	titleLabel.BackgroundTransparency = 1
	titleLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	titleLabel.Position = UDim2.new(0, 80, 0, 0)
	titleLabel.Size = UDim2.new(1, -80, 0, 40)
	titleLabel.Font = Enum.Font.ArialBold
	titleLabel.FontSize = Enum.FontSize.Size36
	titleLabel.TextXAlignment = Enum.TextXAlignment.Center
	titleLabel.TextYAlignment = Enum.TextYAlignment.Center
	titleLabel.Parent = frame

	local messageLabel = Instance.new("TextLabel")
	messageLabel.Name = "Message"
	messageLabel.Text = message
	messageLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	messageLabel.Position = UDim2.new(0.025, 80, 0, 45)
	messageLabel.Size = UDim2.new(0.95, -80, 0, 55)
	messageLabel.BackgroundTransparency = 1
	messageLabel.Font = Enum.Font.Arial
	messageLabel.FontSize = Enum.FontSize.Size18
	messageLabel.TextWrap = true
	messageLabel.TextXAlignment = Enum.TextXAlignment.Left
	messageLabel.TextYAlignment = Enum.TextYAlignment.Top
	messageLabel.Parent = frame

	CreateButtons(frame, buttons, UDim.new(0, 105), UDim.new(0, 40) )

	return frame
end

RbxGuiLib.CreateMessageDialog = function(title, message, buttons)
	local frame = Instance.new("Frame")
	frame.Size = UDim2.new(0.5, 0, 0.5, 0)
	frame.Position = UDim2.new(0.25, 0, 0.25, 0)
	frame.Name = "MessageDialog"
	frame.Active = true
	frame.Style = Enum.FrameStyle.RobloxRound

	local titleLabel = Instance.new("TextLabel")
	titleLabel.Name = "Title"
	titleLabel.Text = title
	titleLabel.BackgroundTransparency = 1
	titleLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	titleLabel.Position = UDim2.new(0, 0, 0, 0)
	titleLabel.Size = UDim2.new(1, 0, 0.15, 0)
	titleLabel.Font = Enum.Font.ArialBold
	titleLabel.FontSize = Enum.FontSize.Size36
	titleLabel.TextXAlignment = Enum.TextXAlignment.Center
	titleLabel.TextYAlignment = Enum.TextYAlignment.Center
	titleLabel.Parent = frame

	local messageLabel = Instance.new("TextLabel")
	messageLabel.Name = "Message"
	messageLabel.Text = message
	messageLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	messageLabel.Position = UDim2.new(0.025, 0, 0.175, 0)
	messageLabel.Size = UDim2.new(0.95, 0, .55, 0)
	messageLabel.BackgroundTransparency = 1
	messageLabel.Font = Enum.Font.Arial
	messageLabel.FontSize = Enum.FontSize.Size18
	messageLabel.TextWrap = true
	messageLabel.TextXAlignment = Enum.TextXAlignment.Left
	messageLabel.TextYAlignment = Enum.TextYAlignment.Top
	messageLabel.Parent = frame

	CreateButtons(frame, buttons, UDim.new(0.8,0), UDim.new(0.15, 0))

	return frame
end

RbxGuiLib.CreateDropDownMenu = function(items, onSelect, forRoblox)
	local width = UDim.new(0, 100)
	local height = UDim.new(0, 32)

	local xPos = 0.055
	local frame = Instance.new("Frame")
	frame.Name = "DropDownMenu"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(width, height)

	local dropDownMenu = Instance.new("TextButton")
	dropDownMenu.Name = "DropDownMenuButton"
	dropDownMenu.TextWrap = true
	dropDownMenu.TextColor3 = Color3.new(1,1,1)
	dropDownMenu.Text = "Choose One"
	dropDownMenu.Font = Enum.Font.ArialBold
	dropDownMenu.FontSize = Enum.FontSize.Size18
	dropDownMenu.TextXAlignment = Enum.TextXAlignment.Left
	dropDownMenu.TextYAlignment = Enum.TextYAlignment.Center
	dropDownMenu.BackgroundTransparency = 1
	dropDownMenu.AutoButtonColor = true
	dropDownMenu.Style = Enum.ButtonStyle.RobloxButton
	dropDownMenu.Size = UDim2.new(1,0,1,0)
	dropDownMenu.Parent = frame
	dropDownMenu.ZIndex = 2

	local dropDownIcon = Instance.new("ImageLabel")
	dropDownIcon.Name = "Icon"
	dropDownIcon.Active = false
	dropDownIcon.Image = "rbxasset://textures/ui/DropDown.png"
	dropDownIcon.BackgroundTransparency = 1
	dropDownIcon.Size = UDim2.new(0,11,0,6)
	dropDownIcon.Position = UDim2.new(1,-11,0.5, -2)
	dropDownIcon.Parent = dropDownMenu
	dropDownIcon.ZIndex = 2
	
	local itemCount = #items
	local dropDownItemCount = #items
	local useScrollButtons = false
	if dropDownItemCount > 6 then
		useScrollButtons = true
		dropDownItemCount = 6
	end
	
	local droppedDownMenu = Instance.new("TextButton")
	droppedDownMenu.Name = "List"
	droppedDownMenu.Text = ""
	droppedDownMenu.BackgroundTransparency = 1
	--droppedDownMenu.AutoButtonColor = true
	droppedDownMenu.Style = Enum.ButtonStyle.RobloxButton
	droppedDownMenu.Visible = false
	droppedDownMenu.Active = true	--Blocks clicks
	droppedDownMenu.Position = UDim2.new(0,0,0,0)
	droppedDownMenu.Size = UDim2.new(1,0, (1 + dropDownItemCount)*.8, 0)
	droppedDownMenu.Parent = frame
	droppedDownMenu.ZIndex = 2

	local choiceButton = Instance.new("TextButton")
	choiceButton.Name = "ChoiceButton"
	choiceButton.BackgroundTransparency = 1
	choiceButton.BorderSizePixel = 0
	choiceButton.Text = "ReplaceMe"
	choiceButton.TextColor3 = Color3.new(1,1,1)
	choiceButton.TextXAlignment = Enum.TextXAlignment.Left
	choiceButton.TextYAlignment = Enum.TextYAlignment.Center
	choiceButton.BackgroundColor3 = Color3.new(1, 1, 1)
	choiceButton.Font = Enum.Font.Arial
	choiceButton.FontSize = Enum.FontSize.Size18
	if useScrollButtons then
		choiceButton.Size = UDim2.new(1,-13, .8/((dropDownItemCount + 1)*.8),0) 
	else
		choiceButton.Size = UDim2.new(1, 0, .8/((dropDownItemCount + 1)*.8),0) 
	end
	choiceButton.TextWrap = true
	choiceButton.ZIndex = 2

	local dropDownSelected = false

	local scrollUpButton 
	local scrollDownButton
	local scrollMouseCount = 0

	local setZIndex = function(baseZIndex)
		droppedDownMenu.ZIndex = baseZIndex +1
		if scrollUpButton then
			scrollUpButton.ZIndex = baseZIndex + 3
		end
		if scrollDownButton then
			scrollDownButton.ZIndex = baseZIndex + 3
		end
		
		local children = droppedDownMenu:GetChildren()
		if children then
			for i, child in ipairs(children) do
				if child.Name == "ChoiceButton" then
					child.ZIndex = baseZIndex + 2
				elseif child.Name == "ClickCaptureButton" then
					child.ZIndex = baseZIndex
				end
			end
		end
	end

	local scrollBarPosition = 1
	local updateScroll = function()
		if scrollUpButton then
			scrollUpButton.Active = scrollBarPosition > 1 
		end
		if scrollDownButton then
			scrollDownButton.Active = scrollBarPosition + dropDownItemCount <= itemCount 
		end

		local children = droppedDownMenu:GetChildren()
		if not children then return end

		local childNum = 1			
		for i, obj in ipairs(children) do
			if obj.Name == "ChoiceButton" then
				if childNum < scrollBarPosition or childNum >= scrollBarPosition + dropDownItemCount then
					obj.Visible = false
				else
					obj.Position = UDim2.new(0,0,((childNum-scrollBarPosition+1)*.8)/((dropDownItemCount+1)*.8),0)
					obj.Visible = true
				end
				obj.TextColor3 = Color3.new(1,1,1)
				obj.BackgroundTransparency = 1

				childNum = childNum + 1
			end
		end
	end
	local toggleVisibility = function()
		dropDownSelected = not dropDownSelected

		dropDownMenu.Visible = not dropDownSelected
		droppedDownMenu.Visible = dropDownSelected
		if dropDownSelected then
			setZIndex(4)
		else
			setZIndex(2)
		end
		if useScrollButtons then
			updateScroll()
		end
	end
	droppedDownMenu.MouseButton1Click:connect(toggleVisibility)

	local updateSelection = function(text)
		local foundItem = false
		local children = droppedDownMenu:GetChildren()
		local childNum = 1
		if children then
			for i, obj in ipairs(children) do
				if obj.Name == "ChoiceButton" then
					if obj.Text == text then
						obj.Font = Enum.Font.ArialBold
						foundItem = true			
						scrollBarPosition = childNum
					else
						obj.Font = Enum.Font.Arial
					end
					childNum = childNum + 1
				end
			end
		end
		if not text then
			dropDownMenu.Text = "Choose One"
			scrollBarPosition = 1
		else
			if not foundItem then
				error("Invalid Selection Update -- " .. text)
			end

			if scrollBarPosition + dropDownItemCount > itemCount + 1 then
				scrollBarPosition = itemCount - dropDownItemCount + 1
			end

			dropDownMenu.Text = text
		end
	end
	
	local function scrollDown()
		if scrollBarPosition + dropDownItemCount <= itemCount then
			scrollBarPosition = scrollBarPosition + 1
			updateScroll()
			return true
		end
		return false
	end
	local function scrollUp()
		if scrollBarPosition > 1 then
			scrollBarPosition = scrollBarPosition - 1
			updateScroll()
			return true
		end
		return false
	end
	
	if useScrollButtons then
		--Make some scroll buttons
		scrollUpButton = Instance.new("ImageButton")
		scrollUpButton.Name = "ScrollUpButton"
		scrollUpButton.BackgroundTransparency = 1
		scrollUpButton.Image = "rbxasset://textures/ui/scrollbuttonUp.png"
		scrollUpButton.Size = UDim2.new(0,17,0,17) 
		scrollUpButton.Position = UDim2.new(1,-11,(1*.8)/((dropDownItemCount+1)*.8),0)
		scrollUpButton.MouseButton1Click:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollUpButton.MouseLeave:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollUpButton.MouseButton1Down:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
	
				scrollUp()
				local val = scrollMouseCount
				wait(0.5)
				while val == scrollMouseCount do
					if scrollUp() == false then
						break
					end
					wait(0.1)
				end				
			end)

		scrollUpButton.Parent = droppedDownMenu

		scrollDownButton = Instance.new("ImageButton")
		scrollDownButton.Name = "ScrollDownButton"
		scrollDownButton.BackgroundTransparency = 1
		scrollDownButton.Image = "rbxasset://textures/ui/scrollbuttonDown.png"
		scrollDownButton.Size = UDim2.new(0,17,0,17) 
		scrollDownButton.Position = UDim2.new(1,-11,1,-11)
		scrollDownButton.Parent = droppedDownMenu
		scrollDownButton.MouseButton1Click:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollDownButton.MouseLeave:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollDownButton.MouseButton1Down:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1

				scrollDown()
				local val = scrollMouseCount
				wait(0.5)
				while val == scrollMouseCount do
					if scrollDown() == false then
						break
					end
					wait(0.1)
				end				
			end)	

		local scrollbar = Instance.new("ImageLabel")
		scrollbar.Name = "ScrollBar"
		scrollbar.Image = "rbxasset://textures/ui/scrollbar.png"
		scrollbar.BackgroundTransparency = 1
		scrollbar.Size = UDim2.new(0, 18, (dropDownItemCount*.8)/((dropDownItemCount+1)*.8), -(17) - 11 - 4)
		scrollbar.Position = UDim2.new(1,-11,(1*.8)/((dropDownItemCount+1)*.8),17+2)
		scrollbar.Parent = droppedDownMenu
	end

	for i,item in ipairs(items) do
		-- needed to maintain local scope for items in event listeners below
		local button = choiceButton:clone()
		if forRoblox then
			button.RobloxLocked = true
		end		
		button.Text = item
		button.Parent = droppedDownMenu
		button.MouseButton1Click:connect(function()
			--Remove Highlight
			button.TextColor3 = Color3.new(1,1,1)
			button.BackgroundTransparency = 1

			updateSelection(item)
			onSelect(item)

			toggleVisibility()
		end)
		button.MouseEnter:connect(function()
			--Add Highlight	
			button.TextColor3 = Color3.new(0,0,0)
			button.BackgroundTransparency = 0
		end)

		button.MouseLeave:connect(function()
			--Remove Highlight
			button.TextColor3 = Color3.new(1,1,1)
			button.BackgroundTransparency = 1
		end)
	end

	--This does the initial layout of the buttons	
	updateScroll()

	local bigFakeButton = Instance.new("TextButton")
	bigFakeButton.BackgroundTransparency = 1
	bigFakeButton.Name = "ClickCaptureButton"
	bigFakeButton.Size = UDim2.new(0, 4000, 0, 3000)
	bigFakeButton.Position = UDim2.new(0, -2000, 0, -1500)
	bigFakeButton.ZIndex = 1
	bigFakeButton.Text = ""
	bigFakeButton.Parent = droppedDownMenu
	bigFakeButton.MouseButton1Click:connect(toggleVisibility)

	dropDownMenu.MouseButton1Click:connect(toggleVisibility)
	return frame, updateSelection
end

RbxGuiLib.CreatePropertyDropDownMenu = function(instance, property, enum)

	local items = enum:GetEnumItems()
	local names = {}
	local nameToItem = {}
	for i,obj in ipairs(items) do
		names[i] = obj.Name
		nameToItem[obj.Name] = obj
	end

	local frame
	local updateSelection
	frame, updateSelection = RbxGuiLib.CreateDropDownMenu(names, function(text) instance[property] = nameToItem[text] end)

	ScopedConnect(frame, instance, "Changed", 
		function(prop)
			if prop == property then
				updateSelection(instance[property].Name)
			end
		end,
		function()
			updateSelection(instance[property].Name)
		end)

	return frame
end

RbxGuiLib.GetFontHeight = function(font, fontSize)
	if font == nil or fontSize == nil then
		error("Font and FontSize must be non-nil")
	end

	if font == Enum.Font.Legacy then
		if fontSize == Enum.FontSize.Size8 then
			return 12
		elseif fontSize == Enum.FontSize.Size9 then
			return 14
		elseif fontSize == Enum.FontSize.Size10 then
			return 15
		elseif fontSize == Enum.FontSize.Size11 then
			return 17
		elseif fontSize == Enum.FontSize.Size12 then
			return 18
		elseif fontSize == Enum.FontSize.Size14 then
			return 21
		elseif fontSize == Enum.FontSize.Size18 then
			return 27
		elseif fontSize == Enum.FontSize.Size24 then
			return 36
		elseif fontSize == Enum.FontSize.Size36 then
			return 54
		elseif fontSize == Enum.FontSize.Size48 then
			return 72
		else
			error("Unknown FontSize")
		end
	elseif font == Enum.Font.Arial or font == Enum.Font.ArialBold then
		if fontSize == Enum.FontSize.Size8 then
			return 8
		elseif fontSize == Enum.FontSize.Size9 then
			return 9
		elseif fontSize == Enum.FontSize.Size10 then
			return 10
		elseif fontSize == Enum.FontSize.Size11 then
			return 11
		elseif fontSize == Enum.FontSize.Size12 then
			return 12
		elseif fontSize == Enum.FontSize.Size14 then
			return 14
		elseif fontSize == Enum.FontSize.Size18 then
			return 18
		elseif fontSize == Enum.FontSize.Size24 then
			return 24
		elseif fontSize == Enum.FontSize.Size36 then
			return 36
		elseif fontSize == Enum.FontSize.Size48 then
			return 48
		else
			error("Unknown FontSize")
		end
	else
		error("Unknown Font " .. font)
	end
end

local function layoutGuiObjectsHelper(frame, guiObjects, settingsTable)
	local totalPixels = frame.AbsoluteSize.Y
	local pixelsRemaining = frame.AbsoluteSize.Y
	for i, child in ipairs(guiObjects) do
		if child:IsA("TextLabel") or child:IsA("TextButton") then
			local isLabel = child:IsA("TextLabel")
			if isLabel then
				pixelsRemaining = pixelsRemaining - settingsTable["TextLabelPositionPadY"]
			else
				pixelsRemaining = pixelsRemaining - settingsTable["TextButtonPositionPadY"]
			end
			child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
			child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, pixelsRemaining)

			if child.TextFits and child.TextBounds.Y < pixelsRemaining then
				child.Visible = true
				if isLabel then
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.TextBounds.Y + settingsTable["TextLabelSizePadY"])
				else 
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.TextBounds.Y + settingsTable["TextButtonSizePadY"])
				end

				while not child.TextFits do
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.AbsoluteSize.Y + 1)
				end
				pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y		

				if isLabel then
					pixelsRemaining = pixelsRemaining - settingsTable["TextLabelPositionPadY"]
				else
					pixelsRemaining = pixelsRemaining - settingsTable["TextButtonPositionPadY"]
				end
			else
				child.Visible = false
				pixelsRemaining = -1
			end			

		else
			--GuiObject
			child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
			pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y
			child.Visible = (pixelsRemaining >= 0)
		end
	end
end

RbxGuiLib.LayoutGuiObjects = function(frame, guiObjects, settingsTable)
	if not frame:IsA("GuiObject") then
		error("Frame must be a GuiObject")
	end
	for i, child in ipairs(guiObjects) do
		if not child:IsA("GuiObject") then
			error("All elements that are layed out must be of type GuiObject")
		end
	end

	if not settingsTable then
		settingsTable = {}
	end

	if not settingsTable["TextLabelSizePadY"] then
		settingsTable["TextLabelSizePadY"] = 0
	end
	if not settingsTable["TextLabelPositionPadY"] then
		settingsTable["TextLabelPositionPadY"] = 0
	end
	if not settingsTable["TextButtonSizePadY"] then
		settingsTable["TextButtonSizePadY"] = 12
	end
	if not settingsTable["TextButtonPositionPadY"] then
		settingsTable["TextButtonPositionPadY"] = 2
	end

	--Wrapper frame takes care of styled objects
	local wrapperFrame = Instance.new("Frame")
	wrapperFrame.Name = "WrapperFrame"
	wrapperFrame.BackgroundTransparency = 1
	wrapperFrame.Size = UDim2.new(1,0,1,0)
	wrapperFrame.Parent = frame

	for i, child in ipairs(guiObjects) do
		child.Parent = wrapperFrame
	end

	local recalculate = function()
		wait()
		layoutGuiObjectsHelper(wrapperFrame, guiObjects, settingsTable)
	end
	
	frame.Changed:connect(
		function(prop)
			if prop == "AbsoluteSize" then
				--Wait a heartbeat for it to sync in
				recalculate()
			end
		end)
	frame.AncestryChanged:connect(recalculate)

	layoutGuiObjectsHelper(wrapperFrame, guiObjects, settingsTable)
end


RbxGuiLib.CreateSlider = function(steps,width,position)
	local sliderGui = Instance.new("Frame")
	sliderGui.Size = UDim2.new(1,0,1,0)
	sliderGui.BackgroundTransparency = 1
	sliderGui.Name = "SliderGui"
	
	local areaSoak = Instance.new("TextButton")
	areaSoak.Name = "AreaSoak"
	areaSoak.Text = ""
	areaSoak.BackgroundTransparency = 1
	areaSoak.Active = false
	areaSoak.Size = UDim2.new(1,0,1,0)
	areaSoak.Visible = false
	areaSoak.ZIndex = 4
	areaSoak.Parent = sliderGui
	
	local sliderPosition = Instance.new("IntValue")
	sliderPosition.Name = "SliderPosition"
	sliderPosition.Value = 0
	sliderPosition.Parent = sliderGui
	
	local id = math.random(1,100)
	
	local bar = Instance.new("Frame")
	bar.Name = "Bar"
	bar.BackgroundColor3 = Color3.new(0,0,0)
	if type(width) == "number" then
		bar.Size = UDim2.new(0,width,0,5)
	else
		bar.Size = UDim2.new(0,200,0,5)
	end
	bar.BorderColor3 = Color3.new(95/255,95/255,95/255)
	bar.ZIndex = 2
	bar.Parent = sliderGui
	
	if position["X"] and position["X"]["Scale"] and position["X"]["Offset"] and position["Y"] and position["Y"]["Scale"] and position["Y"]["Offset"] then
		bar.Position = position
	end
	
	local slider = Instance.new("ImageButton")
	slider.Name = "Slider"
	slider.BackgroundTransparency = 1
	slider.Image = "rbxasset://textures/ui/Slider.png"
	slider.Position = UDim2.new(0,0,0.5,-10)
	slider.Size = UDim2.new(0,20,0,20)
	slider.ZIndex = 3
	slider.Parent = bar
	
	local areaSoakMouseMoveCon = nil
	
	areaSoak.MouseLeave:connect(function()
		if areaSoak.Visible then
			cancelSlide(areaSoak)
		end
	end)
	areaSoak.MouseButton1Up:connect(function()
		if areaSoak.Visible then
			cancelSlide(areaSoak)
		end
	end)
	
	slider.MouseButton1Down:connect(function()
		areaSoak.Visible = true
		if areaSoakMouseMoveCon then areaSoakMouseMoveCon:disconnect() end
		areaSoakMouseMoveCon = areaSoak.MouseMoved:connect(function(x,y)
			setSliderPos(x,slider,sliderPosition,bar,steps)
		end)
	end)
	
	slider.MouseButton1Up:connect(function() cancelSlide(areaSoak) end)
	
	sliderPosition.Changed:connect(function(prop)
		sliderPosition.Value = math.min(steps, math.max(1,sliderPosition.Value))
		local relativePosX = (sliderPosition.Value) / steps
		if relativePosX >= 1 then
			slider.Position = UDim2.new(relativePosX,-20,slider.Position.Y.Scale,slider.Position.Y.Offset)
		else
			slider.Position = UDim2.new(relativePosX,0,slider.Position.Y.Scale,slider.Position.Y.Offset)
		end
	end)
	
	return sliderGui, sliderPosition

end


RbxGuiLib.CreateScrollingFrame = function(orderList,scrollStyle)
	local frame = Instance.new("Frame")
	frame.Name = "ScrollingFrame"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(1,0,1,0)
	
	local scrollUpButton = Instance.new("ImageButton")
	scrollUpButton.Name = "ScrollUpButton"
	scrollUpButton.BackgroundTransparency = 1
	scrollUpButton.Image = "rbxasset://textures/ui/scrollbuttonUp.png"
	scrollUpButton.Size = UDim2.new(0,17,0,17) 

	
	local scrollDownButton = Instance.new("ImageButton")
	scrollDownButton.Name = "ScrollDownButton"
	scrollDownButton.BackgroundTransparency = 1
	scrollDownButton.Image = "rbxasset://textures/ui/scrollbuttonDown.png"
	scrollDownButton.Size = UDim2.new(0,17,0,17) 

	local style = "simple"
	if scrollStyle and tostring(scrollStyle) then
		style = scrollStyle
	end
	
	local scrollPosition = 1
	local rowSize = 1
	
	local layoutGridScrollBar = function()
		local guiObjects = {}
		if orderList then
			for i, child in ipairs(orderList) do
				if child.Parent == frame then
					table.insert(guiObjects, child)
				end
			end
		else
			local children = frame:GetChildren()
			if children then
				for i, child in ipairs(children) do 
					if child:IsA("GuiObject") then
						table.insert(guiObjects, child)
					end
				end
			end
		end
		if #guiObjects == 0 then
			scrollUpButton.Active = false
			scrollDownButton.Active = false
			scrollPosition = 1
			return
		end

		if scrollPosition > #guiObjects then
			scrollPosition = #guiObjects
		end
		
		local totalPixelsY = frame.AbsoluteSize.Y
		local pixelsRemainingY = frame.AbsoluteSize.Y
		
		local totalPixelsX  = frame.AbsoluteSize.X
		
		local xCounter = 0
		local rowSizeCounter = 0
		local setRowSize = true

		local pixelsBelowScrollbar = 0
		local pos = #guiObjects
		while pixelsBelowScrollbar < totalPixelsY and pos >= 1 do
			if pos >= scrollPosition then
				pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
			else
				xCounter = xCounter + guiObjects[pos].AbsoluteSize.X
				rowSizeCounter = rowSizeCounter + 1
				if xCounter >= totalPixelsX then
					if setRowSize then
						rowSize = rowSizeCounter - 1
						setRowSize = false
					end
					
					rowSizeCounter = 0
					xCounter = 0
					if pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y <= totalPixelsY then
						--It fits, so back up our scroll position
						pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
						if scrollPosition <= rowSize then
							scrollPosition = rowSize 
							break
						else
							--print("Backing up ScrollPosition from -- " ..scrollPosition)
							scrollPosition = scrollPosition - rowSize 
						end
					else
						break
					end
				end
			end
			pos = pos - 1
		end

		xCounter = 0
		--print("ScrollPosition = " .. scrollPosition)
		pos = scrollPosition
		rowSizeCounter = 0
		setRowSize = true
		local lastChildSize = 0
		
		local xOffset,yOffset = 0
		if guiObjects[1] then
			yOffset = math.ceil(math.floor(math.fmod(totalPixelsY,guiObjects[1].AbsoluteSize.X))/2)
			xOffset = math.ceil(math.floor(math.fmod(totalPixelsX,guiObjects[1].AbsoluteSize.Y))/2)
		end
		
		for i, child in ipairs(guiObjects) do
			if i < scrollPosition then
				--print("Hiding " .. child.Name)
				child.Visible = false
			else
				if pixelsRemainingY < 0 then
					--print("Out of Space " .. child.Name)
					child.Visible = false
				else
					--print("Laying out " .. child.Name)
					--GuiObject
					if setRowSize then rowSizeCounter = rowSizeCounter + 1 end
					if xCounter + child.AbsoluteSize.X >= totalPixelsX then
						if setRowSize then
							rowSize = rowSizeCounter - 1
							setRowSize = false
						end
						xCounter = 0
						pixelsRemainingY = pixelsRemainingY - child.AbsoluteSize.Y
					end
					child.Position = UDim2.new(child.Position.X.Scale,xCounter + xOffset, 0, totalPixelsY - pixelsRemainingY + yOffset)
					xCounter = xCounter + child.AbsoluteSize.X
					child.Visible = ((pixelsRemainingY - child.AbsoluteSize.Y) >= 0)
					lastChildSize = child.AbsoluteSize				
				end
			end
		end

		scrollUpButton.Active = (scrollPosition > 1)
		if lastChildSize == 0 then 
			scrollDownButton.Active = false
		else
			scrollDownButton.Active = ((pixelsRemainingY - lastChildSize.Y) < 0)
		end
	end


	local layoutSimpleScrollBar = function()
		local guiObjects = {}	
		
		if orderList then
			for i, child in ipairs(orderList) do
				if child.Parent == frame then
					table.insert(guiObjects, child)
				end
			end
		else
			local children = frame:GetChildren()
			if children then
				for i, child in ipairs(children) do 
					if child:IsA("GuiObject") then
						table.insert(guiObjects, child)
					end
				end
			end
		end
		if #guiObjects == 0 then
			scrollUpButton.Active = false
			scrollDownButton.Active = false
			scrollPosition = 1
			return
		end

		if scrollPosition > #guiObjects then
			scrollPosition = #guiObjects
		end
		
		local totalPixels = frame.AbsoluteSize.Y
		local pixelsRemaining = frame.AbsoluteSize.Y

		local pixelsBelowScrollbar = 0
		local pos = #guiObjects
		while pixelsBelowScrollbar < totalPixels and pos >= 1 do
			if pos >= scrollPosition then
				pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
			else
				if pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y <= totalPixels then
					--It fits, so back up our scroll position
					pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
					if scrollPosition <= 1 then
						scrollPosition = 1
						break
					else
						--print("Backing up ScrollPosition from -- " ..scrollPosition)
						scrollPosition = scrollPosition - 1
					end
				else
					break
				end
			end
			pos = pos - 1
		end

		--print("ScrollPosition = " .. scrollPosition)
		pos = scrollPosition
		for i, child in ipairs(guiObjects) do
			if i < scrollPosition then
				--print("Hiding " .. child.Name)
				child.Visible = false
			else
				if pixelsRemaining < 0 then
					--print("Out of Space " .. child.Name)
					child.Visible = false
				else
					--print("Laying out " .. child.Name)
					--GuiObject
					child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
					pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y
					child.Visible = (pixelsRemaining >= 0)				
				end
			end
		end
		scrollUpButton.Active = (scrollPosition > 1)
		scrollDownButton.Active = (pixelsRemaining < 0)
	end

	local reentrancyGuard = false
	local recalculate = function()
		if reentrancyGuard then
			return
		end
		reentrancyGuard = true
		wait()
		local success, err = nil
		if style == "grid" then
			success, err = pcall(function() layoutGridScrollBar(frame) end)
		elseif style == "simple" then
			success, err = pcall(function() layoutSimpleScrollBar(frame) end)
		end
		if not success then print(err) end

		reentrancyGuard = false
	end

	local scrollUp = function()
		if scrollUpButton.Active then
			scrollPosition = scrollPosition - rowSize
			recalculate()
		end
	end

	local scrollDown = function()
		if scrollDownButton.Active then
			scrollPosition = scrollPosition + rowSize
			recalculate()
		end
	end

	local scrollMouseCount = 0
	scrollUpButton.MouseButton1Click:connect(
		function()
			--print("Up-MouseButton1Click")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollUpButton.MouseLeave:connect(
		function()
			--print("Up-Leave")
			scrollMouseCount = scrollMouseCount + 1
		end)

	scrollUpButton.MouseButton1Down:connect(
		function()
			--print("Up-Down")
			scrollMouseCount = scrollMouseCount + 1

			scrollUp()
			local val = scrollMouseCount
			wait(0.5)
			while val == scrollMouseCount do
				if scrollUp() == false then
					break
				end
				wait(0.1)
			end				
		end)

	scrollDownButton.MouseButton1Click:connect(
		function()
			--print("Down-Click")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollDownButton.MouseLeave:connect(
		function()
			--print("Down-Leave")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollDownButton.MouseButton1Down:connect(
		function()
			--print("Down-Down")
			scrollMouseCount = scrollMouseCount + 1

			scrollDown()
			local val = scrollMouseCount
			wait(0.5)
			while val == scrollMouseCount do
				if scrollDown() == false then
					break
				end
				wait(0.1)
			end				
		end)


	frame.ChildAdded:connect(function()
		recalculate()
	end)

	frame.ChildRemoved:connect(function()
		recalculate()
	end)
	
	frame.Changed:connect(
		function(prop)
			if prop == "AbsoluteSize" then
				--Wait a heartbeat for it to sync in
				recalculate()
			end
		end)
	frame.AncestryChanged:connect(recalculate)

	return frame, scrollUpButton, scrollDownButton, recalculate
end
local function binaryGrow(min, max, fits)
	if min > max then
		return min
	end
	local biggestLegal = min

	while min <= max do
		local mid = min + math.floor((max - min) / 2)
		if fits(mid) and (biggestLegal == nil or biggestLegal < mid) then
			biggestLegal = mid
			
			--Try growing
			min = mid + 1
		else
			--Doesn't fit, shrink
			max = mid - 1
		end
	end
	return biggestLegal
end


local function binaryShrink(min, max, fits)
	if min > max then
		return min
	end
	local smallestLegal = max

	while min <= max do
		local mid = min + math.floor((max - min) / 2)
		if fits(mid) and (smallestLegal == nil or smallestLegal > mid) then
			smallestLegal = mid
			
			--It fits, shrink
			max = mid - 1			
		else
			--Doesn't fit, grow
			min = mid + 1
		end
	end
	return smallestLegal
end


local function getGuiOwner(instance)
	while instance ~= nil do
		if instance:IsA("ScreenGui") or instance:IsA("BillboardGui")  then
			return instance
		end
		instance = instance.Parent
	end
	return nil
end

RbxGuiLib.AutoTruncateTextObject = function(textLabel)
	local text = textLabel.Text

	local fullLabel = textLabel:Clone()
	fullLabel.Name = "Full" .. textLabel.Name 
	fullLabel.BorderSizePixel = 0
	fullLabel.BackgroundTransparency = 0
	fullLabel.Text = text
	fullLabel.TextXAlignment = Enum.TextXAlignment.Center
	fullLabel.Position = UDim2.new(0,-3,0,0)
	fullLabel.Size = UDim2.new(0,100,1,0)
	fullLabel.Visible = false
	fullLabel.Parent = textLabel

	local shortText = nil
	local mouseEnterConnection = nil
	local mouseLeaveConnection= nil

	local checkForResize = function()
		if getGuiOwner(textLabel) == nil then
			return
		end
		textLabel.Text = text
		if textLabel.TextFits then 
			--Tear down the rollover if it is active
			if mouseEnterConnection then
				mouseEnterConnection:disconnect()
				mouseEnterConnection = nil
			end
			if mouseLeaveConnection then
				mouseLeaveConnection:disconnect()
				mouseLeaveConnection = nil
			end
		else
			local len = string.len(text)
			textLabel.Text = text .. "~"

			--Shrink the text
			local textSize = binaryGrow(0, len, 
				function(pos)
					if pos == 0 then
						textLabel.Text = "~"
					else
						textLabel.Text = string.sub(text, 1, pos) .. "~"
					end
					return textLabel.TextFits
				end)
			shortText = string.sub(text, 1, textSize) .. "~"
			textLabel.Text = shortText
			
			--Make sure the fullLabel fits
			if not fullLabel.TextFits then
				--Already too small, grow it really bit to start
				fullLabel.Size = UDim2.new(0, 10000, 1, 0)
			end
			
			--Okay, now try to binary shrink it back down
			local fullLabelSize = binaryShrink(textLabel.AbsoluteSize.X,fullLabel.AbsoluteSize.X, 
				function(size)
					fullLabel.Size = UDim2.new(0, size, 1, 0)
					return fullLabel.TextFits
				end)
			fullLabel.Size = UDim2.new(0,fullLabelSize+6,1,0)

			--Now setup the rollover effects, if they are currently off
			if mouseEnterConnection == nil then
				mouseEnterConnection = textLabel.MouseEnter:connect(
					function()
						fullLabel.ZIndex = textLabel.ZIndex + 1
						fullLabel.Visible = true
						--textLabel.Text = ""
					end)
			end
			if mouseLeaveConnection == nil then
				mouseLeaveConnection = textLabel.MouseLeave:connect(
					function()
						fullLabel.Visible = false
						--textLabel.Text = shortText
					end)
			end
		end
	end
	textLabel.AncestryChanged:connect(checkForResize)
	textLabel.Changed:connect(
		function(prop) 
			if prop == "AbsoluteSize" then 
				checkForResize() 	
			end 
		end)

	checkForResize()

	local function changeText(newText)
		text = newText
		fullLabel.Text = text
		checkForResize()
	end

	return textLabel, changeText
end

local function TransitionTutorialPages(fromPage, toPage, transitionFrame, currentPageValue)	
	if fromPage then
		fromPage.Visible = false
		if transitionFrame.Visible == false then
			transitionFrame.Size = fromPage.Size
			transitionFrame.Position = fromPage.Position
		end
	else
		if transitionFrame.Visible == false then
			transitionFrame.Size = UDim2.new(0.0,50,0.0,50)
			transitionFrame.Position = UDim2.new(0.5,-25,0.5,-25)
		end
	end
	transitionFrame.Visible = true
	currentPageValue.Value = nil

	local newsize, newPosition
	if toPage then
		--Make it visible so it resizes
		toPage.Visible = true

		newSize = toPage.Size
		newPosition = toPage.Position

		toPage.Visible = false
	else
		newSize = UDim2.new(0.0,50,0.0,50)
		newPosition = UDim2.new(0.5,-25,0.5,-25)
	end
	transitionFrame:TweenSizeAndPosition(newSize, newPosition, Enum.EasingDirection.InOut, Enum.EasingStyle.Quad, 0.3, true,
		function(state)
			if state == Enum.TweenStatus.Completed then
				transitionFrame.Visible = false
				if toPage then
					toPage.Visible = true
					currentPageValue.Value = toPage
				end
			end
		end)
end

RbxGuiLib.CreateTutorial = function(name, tutorialKey, createButtons)
	local frame = Instance.new("Frame")
	frame.Name = "Tutorial-" .. name
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(0.6, 0, 0.6, 0)
	frame.Position = UDim2.new(0.2, 0, 0.2, 0)

	local transitionFrame = Instance.new("Frame")
	transitionFrame.Name = "TransitionFrame"
	transitionFrame.Style = Enum.FrameStyle.RobloxRound
	transitionFrame.Size = UDim2.new(0.6, 0, 0.6, 0)
	transitionFrame.Position = UDim2.new(0.2, 0, 0.2, 0)
	transitionFrame.Visible = false
	transitionFrame.Parent = frame

	local currentPageValue = Instance.new("ObjectValue")
	currentPageValue.Name = "CurrentTutorialPage"
	currentPageValue.Value = nil
	currentPageValue.Parent = frame

	local boolValue = Instance.new("BoolValue")
	boolValue.Name = "Buttons"
	boolValue.Value = createButtons
	boolValue.Parent = frame

	local pages = Instance.new("Frame")
	pages.Name = "Pages"
	pages.BackgroundTransparency = 1
	pages.Size = UDim2.new(1,0,1,0)
	pages.Parent = frame

	local function getVisiblePageAndHideOthers()
		local visiblePage = nil
		local children = pages:GetChildren()
		if children then
			for i,child in ipairs(children) do
				if child.Visible then
					if visiblePage then
						child.Visible = false
					else
						visiblePage = child
					end
				end
			end
		end
		return visiblePage
	end

	local showTutorial = function(alwaysShow)
		if alwaysShow or UserSettings().GameSettings:GetTutorialState(tutorialKey) == false then
			print("Showing tutorial-",tutorialKey)
			local currentTutorialPage = getVisiblePageAndHideOthers()

			local firstPage = pages:FindFirstChild("TutorialPage1")
			if firstPage then
				TransitionTutorialPages(currentTutorialPage, firstPage, transitionFrame, currentPageValue)	
			else
				error("Could not find TutorialPage1")
			end
		end
	end

	local dismissTutorial = function()
		local currentTutorialPage = getVisiblePageAndHideOthers()

		if currentTutorialPage then
			TransitionTutorialPages(currentTutorialPage, nil, transitionFrame, currentPageValue)
		end

		UserSettings().GameSettings:SetTutorialState(tutorialKey, true)
	end

	local gotoPage = function(pageNum)
		local page = pages:FindFirstChild("TutorialPage" .. pageNum)
		local currentTutorialPage = getVisiblePageAndHideOthers()
		TransitionTutorialPages(currentTutorialPage, page, transitionFrame, currentPageValue)
	end

	return frame, showTutorial, dismissTutorial, gotoPage
end 

local function CreateBasicTutorialPage(name, handleResize, skipTutorial)
	local frame = Instance.new("Frame")
	frame.Name = "TutorialPage"
	frame.Style = Enum.FrameStyle.RobloxRound
	frame.Size = UDim2.new(0.6, 0, 0.6, 0)
	frame.Position = UDim2.new(0.2, 0, 0.2, 0)
	frame.Visible = false
	
	local frameHeader = Instance.new("TextLabel")
	frameHeader.Name = "Header"
	frameHeader.Text = name
	frameHeader.BackgroundTransparency = 1
	frameHeader.FontSize = Enum.FontSize.Size24
	frameHeader.Font = Enum.Font.ArialBold
	frameHeader.TextColor3 = Color3.new(1,1,1)
	frameHeader.TextXAlignment = Enum.TextXAlignment.Center
	frameHeader.TextWrap = true
	frameHeader.Size = UDim2.new(1,-55, 0, 22)
	frameHeader.Position = UDim2.new(0,0,0,0)
	frameHeader.Parent = frame

	local skipButton = Instance.new("ImageButton")
	skipButton.Name = "SkipButton"
	skipButton.AutoButtonColor = false
	skipButton.BackgroundTransparency = 1
	skipButton.Image = "rbxasset://textures/ui/Skip.png"	
	skipButton.MouseButton1Click:connect(function()
		skipButton.Image = "rbxasset://textures/ui/Skip.png"	
		skipTutorial()
	end)
	skipButton.MouseEnter:connect(function()
		skipButton.Image = "rbxasset://textures/ui/SkipEnter.png"	
	end)
	skipButton.MouseLeave:connect(function()
		skipButton.Image = "rbxasset://textures/ui/Skip.png"	
	end)
	skipButton.Size = UDim2.new(0, 55, 0, 22)
	skipButton.Position = UDim2.new(1, -55, 0, 0)
	skipButton.Parent = frame

	local innerFrame = Instance.new("Frame")
	innerFrame.Name = "ContentFrame"
	innerFrame.BackgroundTransparency = 1
	innerFrame.Position = UDim2.new(0,0,0,22)
	innerFrame.Parent = frame

	local nextButton = Instance.new("TextButton")
	nextButton.Name = "NextButton"
	nextButton.Text = "Next"
	nextButton.TextColor3 = Color3.new(1,1,1)
	nextButton.Font = Enum.Font.Arial
	nextButton.FontSize = Enum.FontSize.Size18
	nextButton.Style = Enum.ButtonStyle.RobloxButtonDefault
	nextButton.Size = UDim2.new(0,80, 0, 32)
	nextButton.Position = UDim2.new(0.5, 5, 1, -32)
	nextButton.Active = false
	nextButton.Visible = false
	nextButton.Parent = frame

	local prevButton = Instance.new("TextButton")
	prevButton.Name = "PrevButton"
	prevButton.Text = "Previous"
	prevButton.TextColor3 = Color3.new(1,1,1)
	prevButton.Font = Enum.Font.Arial
	prevButton.FontSize = Enum.FontSize.Size18
	prevButton.Style = Enum.ButtonStyle.RobloxButton
	prevButton.Size = UDim2.new(0,80, 0, 32)
	prevButton.Position = UDim2.new(0.5, -85, 1, -32)
	prevButton.Active = false
	prevButton.Visible = false
	prevButton.Parent = frame

	innerFrame.Size = UDim2.new(1,0,1,-22-35)

	local parentConnection = nil

	local function basicHandleResize()
		if frame.Visible and frame.Parent then
			local maxSize = math.min(frame.Parent.AbsoluteSize.X, frame.Parent.AbsoluteSize.Y)
			handleResize(200,maxSize)
		end
	end

	frame.Changed:connect(
		function(prop)
			if prop == "Parent" then
				if parentConnection ~= nil then
					parentConnection:disconnect()
					parentConnection = nil
				end
				if frame.Parent and frame.Parent:IsA("GuiObject") then
					parentConnection = frame.Parent.Changed:connect(
						function(parentProp)
							if parentProp == "AbsoluteSize" then
								wait()
								basicHandleResize()
							end
						end)
					basicHandleResize()
				end
			end

			if prop == "Visible" then 
				basicHandleResize()
			end
		end)

	return frame, innerFrame
end

RbxGuiLib.CreateTextTutorialPage = function(name, text, skipTutorialFunc)
	local frame = nil
	local contentFrame = nil

	local textLabel = Instance.new("TextLabel")
	textLabel.BackgroundTransparency = 1
	textLabel.TextColor3 = Color3.new(1,1,1)
	textLabel.Text = text
	textLabel.TextWrap = true
	textLabel.TextXAlignment = Enum.TextXAlignment.Left
	textLabel.TextYAlignment = Enum.TextYAlignment.Center
	textLabel.Font = Enum.Font.Arial
	textLabel.FontSize = Enum.FontSize.Size14
	textLabel.Size = UDim2.new(1,0,1,0)

	local function handleResize(minSize, maxSize)
		size = binaryShrink(minSize, maxSize,
			function(size)
				frame.Size = UDim2.new(0, size, 0, size)
				return textLabel.TextFits
			end)
		frame.Size = UDim2.new(0, size, 0, size)
		frame.Position = UDim2.new(0.5, -size/2, 0.5, -size/2)
	end

	frame, contentFrame = CreateBasicTutorialPage(name, handleResize, skipTutorialFunc)
	textLabel.Parent = contentFrame

	return frame
end

RbxGuiLib.CreateImageTutorialPage = function(name, imageAsset, x, y, skipTutorialFunc)
	local frame = nil
	local contentFrame = nil

	local imageLabel = Instance.new("ImageLabel")
	imageLabel.BackgroundTransparency = 1
	imageLabel.Image = imageAsset
	imageLabel.Size = UDim2.new(0,x,0,y)
	imageLabel.Position = UDim2.new(0.5,-x/2,0.5,-y/2)

	local function handleResize(minSize, maxSize)
		size = binaryShrink(minSize, maxSize,
			function(size)
				return size >= x and size >= y
			end)
		if size >= x and size >= y then
			imageLabel.Size = UDim2.new(0,x, 0,y)
			imageLabel.Position = UDim2.new(0.5,-x/2, 0.5, -y/2)
		else
			if x > y then
				--X is limiter, so 
				imageLabel.Size = UDim2.new(1,0,y/x,0)
				imageLabel.Position = UDim2.new(0,0, 0.5 - (y/x)/2, 0)
			else
				--Y is limiter
				imageLabel.Size = UDim2.new(x/y,0,1, 0)
				imageLabel.Position = UDim2.new(0.5-(x/y)/2, 0, 0, 0)
			end
		end
		frame.Size = UDim2.new(0, size, 0, size)
		frame.Position = UDim2.new(0.5, -size/2, 0.5, -size/2)
	end

	frame, contentFrame = CreateBasicTutorialPage(name, handleResize, skipTutorialFunc)
	imageLabel.Parent = contentFrame

	return frame
end

RbxGuiLib.AddTutorialPage = function(tutorial, tutorialPage)
	local transitionFrame = tutorial.TransitionFrame
	local currentPageValue = tutorial.CurrentTutorialPage

	if not tutorial.Buttons.Value then
		tutorialPage.ContentFrame.Size = UDim2.new(1,0,1,-22)
		tutorialPage.NextButton.Parent = nil
		tutorialPage.PrevButton.Parent = nil
	end

	local children = tutorial.Pages:GetChildren()
	if children and #children > 0 then
		tutorialPage.Name = "TutorialPage" .. (#children+1)
		local previousPage = children[#children]
		if not previousPage:IsA("GuiObject") then
			error("All elements under Pages must be GuiObjects")
		end

		if tutorial.Buttons.Value then
			if previousPage.NextButton.Active then
				error("NextButton already Active on previousPage, please only add pages with RbxGui.AddTutorialPage function")
			end
			previousPage.NextButton.MouseButton1Click:connect(
				function()
					TransitionTutorialPages(previousPage, tutorialPage, transitionFrame, currentPageValue)
				end)
			previousPage.NextButton.Active = true
			previousPage.NextButton.Visible = true

			if tutorialPage.PrevButton.Active then
				error("PrevButton already Active on tutorialPage, please only add pages with RbxGui.AddTutorialPage function")
			end
			tutorialPage.PrevButton.MouseButton1Click:connect(
				function()
					TransitionTutorialPages(tutorialPage, previousPage, transitionFrame, currentPageValue)
				end)
			tutorialPage.PrevButton.Active = true
			tutorialPage.PrevButton.Visible = true
		end

		tutorialPage.Parent = tutorial.Pages
	else
		--First child
		tutorialPage.Name = "TutorialPage1"
		tutorialPage.Parent = tutorial.Pages
	end
end 

RbxGuiLib.Help = 
	function(funcNameOrFunc) 
		--input argument can be a string or a function.  Should return a description (of arguments and expected side effects)
		if funcNameOrFunc == "CreatePropertyDropDownMenu" or funcNameOrFunc == RbxGuiLib.CreatePropertyDropDownMenu then
			return "Function CreatePropertyDropDownMenu.  " ..
				   "Arguments: (instance, propertyName, enumType).  " .. 
				   "Side effect: returns a container with a drop-down-box that is linked to the 'property' field of 'instance' which is of type 'enumType'" 
		end 
		if funcNameOrFunc == "CreateDropDownMenu" or funcNameOrFunc == RbxGuiLib.CreateDropDownMenu then
			return "Function CreateDropDownMenu.  " .. 
			       "Arguments: (items, onItemSelected).  " .. 
				   "Side effect: Returns 2 results, a container to the gui object and a 'updateSelection' function for external updating.  The container is a drop-down-box created around a list of items" 
		end 
		if funcNameOrFunc == "CreateMessageDialog" or funcNameOrFunc == RbxGuiLib.CreateMessageDialog then
			return "Function CreateMessageDialog.  " .. 
			       "Arguments: (title, message, buttons). " .. 
			       "Side effect: Returns a gui object of a message box with 'title' and 'message' as passed in.  'buttons' input is an array of Tables contains a 'Text' and 'Function' field for the text/callback of each button"
		end		
		if funcNameOrFunc == "CreateStyledMessageDialog" or funcNameOrFunc == RbxGuiLib.CreateStyledMessageDialog then
			return "Function CreateStyledMessageDialog.  " .. 
			       "Arguments: (title, message, style, buttons). " .. 
			       "Side effect: Returns a gui object of a message box with 'title' and 'message' as passed in.  'buttons' input is an array of Tables contains a 'Text' and 'Function' field for the text/callback of each button, 'style' is a string, either Error, Notify or Confirm"
		end
		if funcNameOrFunc == "GetFontHeight" or funcNameOrFunc == RbxGuiLib.GetFontHeight then
			return "Function GetFontHeight.  " .. 
			       "Arguments: (font, fontSize). " .. 
			       "Side effect: returns the size in pixels of the given font + fontSize"
		end
		if funcNameOrFunc == "LayoutGuiObjects" or funcNameOrFunc == RbxGuiLib.LayoutGuiObjects then
		
		end
		if funcNameOrFunc == "CreateScrollingFrame" or funcNameOrFunc == RbxGuiLib.CreateScrollingFrame then
			return "Function CreateScrollingFrame.  " .. 
			   "Arguments: (orderList, style) " .. 
			   "Side effect: returns 4 objects, (scrollFrame, scrollUpButton, scrollDownButton, recalculateFunction).  'scrollFrame' can be filled with GuiObjects.  It will lay them out and allow scrollUpButton/scrollDownButton to interact with them.  Orderlist is optional (and specifies the order to layout the children.  Without orderlist, it uses the children order. style is also optional, and allows for a 'grid' styling if style is passed 'grid' as a string.  recalculateFunction can be called when a relayout is needed (when orderList changes)"
		end
		if funcNameOrFunc == "AutoTruncateTextObject" or funcNameOrFunc == RbxGuiLib.AutoTruncateTextObject then
			return "Function AutoTruncateTextObject.  " .. 
			   "Arguments: (textLabel) " .. 
			   "Side effect: returns 2 objects, (textLabel, changeText).  The 'textLabel' input is modified to automatically truncate text (with ellipsis), if it gets too small to fit.  'changeText' is a function that can be used to change the text, it takes 1 string as an argument"
		end
		if funcNameOrFunc == "CreateSlider" or funcNameOrFunc == RbxGuiLib.CreateSlider then
			return "Function CreateSlider.  " ..
				"Arguments: (steps, width, position) " ..
				"Side effect: returns 2 objects, (sliderGui, sliderPosition).  The 'steps' argument specifies how many different positions the slider can hold along the bar.  'width' specifies in pixels how wide the bar should be (modifiable afterwards if desired). 'position' argument should be a UDim2 for slider positioning. 'sliderPosition' is an IntValue whose current .Value specifies the specific step the slider is currently on."
		end
	end
-- RBXGUI END --

delay(0, function()

if game.CoreGui.Version < 3 then return end -- peace out if we aren't using the right client

-- A couple of necessary functions
local function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end
local function waitForProperty(instance, property)
	while not instance[property] do
		instance.Changed:wait()
	end
end

waitForChild(game,"Players")
waitForProperty(game.Players,"LocalPlayer")
local player = game.Players.LocalPlayer

local RbxGui,msg = RbxGuiLib
if not RbxGui then print("could not find RbxGui!") return end

--- Begin Locals
waitForChild(game,"Players")

-- don't do anything if we are in an empty game
if #game.Players:GetChildren() < 1 then
	game.Players.ChildAdded:wait()
end

local tilde = "~"
local backquote = "`"
game:GetService("GuiService"):AddKey(tilde) -- register our keys
game:GetService("GuiService"):AddKey(backquote)

local player = game.Players.LocalPlayer

local backpack = game:GetService("CoreGui").RobloxGui:FindFirstChild("Backpack")
local screen = game:GetService("CoreGui").RobloxGui
local closeButton = backpack.Tabs.CloseButton

local openCloseDebounce = false

local backpackItems = {}

local buttons = {}

local debounce = false

local guiTweenSpeed = 1

local backpackOldStateVisible = false
local browsingMenu = false

local mouseEnterCons = {}
local mouseClickCons = {}

local characterChildAddedCon = nil
local characterChildRemovedCon = nil
local backpackAddCon = nil
local humanoidDiedCon = nil
local backpackButtonClickCon = nil
local guiServiceKeyPressCon = nil

waitForChild(player,"Backpack")
local playerBackpack = player.Backpack

waitForChild(backpack,"Gear")
waitForChild(backpack.Gear,"GearPreview")
local gearPreview = backpack.Gear.GearPreview

waitForChild(backpack.Gear,"GearGridScrollingArea")
local scroller = backpack.Gear.GearGridScrollingArea

waitForChild(backpack.Parent,"CurrentLoadout")
local currentLoadout = backpack.Parent.CurrentLoadout

waitForChild(backpack.Parent,"ControlFrame")
waitForChild(backpack.Parent.ControlFrame,"BackpackButton")
local backpackButton = backpack.Parent.ControlFrame.BackpackButton

waitForChild(backpack.Gear,"GearGrid")
waitForChild(backpack.Gear.GearGrid,"GearButton")
local gearButton = backpack.Gear.GearGrid.GearButton
local grid = backpack.Gear.GearGrid

waitForChild(backpack.Gear.GearGrid,"SearchFrame")
waitForChild(backpack.Gear.GearGrid.SearchFrame,"SearchBoxFrame")
waitForChild(backpack.Gear.GearGrid.SearchFrame.SearchBoxFrame,"SearchBox")
local searchBox = backpack.Gear.GearGrid.SearchFrame.SearchBoxFrame.SearchBox

waitForChild(backpack.Gear.GearGrid.SearchFrame,"SearchButton")
local searchButton = backpack.Gear.GearGrid.SearchFrame.SearchButton

waitForChild(backpack.Gear.GearGrid,"ResetFrame")
local resetFrame = backpack.Gear.GearGrid.ResetFrame

waitForChild(backpack.Gear.GearGrid.ResetFrame,"ResetButtonBorder")
local resetButton = backpack.Gear.GearGrid.ResetFrame.ResetButtonBorder

waitForChild(backpack,"SwapSlot")
local swapSlot = backpack.SwapSlot


-- creating scroll bar early as to make sure items get placed correctly
local scrollFrame, scrollUp, scrollDown, recalculateScroll = RbxGui.CreateScrollingFrame(nil,"grid")

scrollFrame.Position = UDim2.new(0,0,0,30)
scrollFrame.Size = UDim2.new(1,0,1,-30)
scrollFrame.Parent = backpack.Gear.GearGrid

local scrollBar = Instance.new("Frame")
scrollBar.Name = "ScrollBar"
scrollBar.BackgroundTransparency = 0.9
scrollBar.BackgroundColor3 = Color3.new(1,1,1)
scrollBar.BorderSizePixel = 0
scrollBar.Size = UDim2.new(0, 17, 1, -36)
scrollBar.Position = UDim2.new(0,0,0,18)
scrollBar.Parent = scroller

scrollDown.Position = UDim2.new(0,0,1,-17)

scrollUp.Parent = scroller
scrollDown.Parent = scroller

local scrollFrameLoadout, scrollUpLoadout, scrollDownLoadout, recalculateScrollLoadout = RbxGui.CreateScrollingFrame()

scrollFrameLoadout.Position = UDim2.new(0,0,0,0)
scrollFrameLoadout.Size = UDim2.new(1,0,1,0)
scrollFrameLoadout.Parent = backpack.Gear.GearLoadouts.LoadoutsList

local LoadoutButton = Instance.new("TextButton")
LoadoutButton.RobloxLocked = true
LoadoutButton.Name = "LoadoutButton"
LoadoutButton.Font = Enum.Font.ArialBold
LoadoutButton.FontSize = Enum.FontSize.Size14
LoadoutButton.Position = UDim2.new(0,0,0,0)
LoadoutButton.Size = UDim2.new(1,0,0,32)
LoadoutButton.Style = Enum.ButtonStyle.RobloxButton
LoadoutButton.Text = "Loadout #1"
LoadoutButton.TextColor3 = Color3.new(1,1,1)
LoadoutButton.Parent = scrollFrameLoadout

local LoadoutButtonTwo = LoadoutButton:clone()
LoadoutButtonTwo.Text = "Loadout #2"
LoadoutButtonTwo.Parent = scrollFrameLoadout

local LoadoutButtonThree = LoadoutButton:clone()
LoadoutButtonThree.Text = "Loadout #3"
LoadoutButtonThree.Parent = scrollFrameLoadout

local LoadoutButtonFour = LoadoutButton:clone()
LoadoutButtonFour.Text = "Loadout #4"
LoadoutButtonFour.Parent = scrollFrameLoadout

local scrollBarLoadout = Instance.new("Frame")
scrollBarLoadout.Name = "ScrollBarLoadout"
scrollBarLoadout.BackgroundTransparency = 0.9
scrollBarLoadout.BackgroundColor3 = Color3.new(1,1,1)
scrollBarLoadout.BorderSizePixel = 0
scrollBarLoadout.Size = UDim2.new(0, 17, 1, -36)
scrollBarLoadout.Position = UDim2.new(0,0,0,18)
scrollBarLoadout.Parent = backpack.Gear.GearLoadouts.GearLoadoutsScrollingArea

scrollDownLoadout.Position = UDim2.new(0,0,1,-17)

scrollUpLoadout.Parent = backpack.Gear.GearLoadouts.GearLoadoutsScrollingArea
scrollDownLoadout.Parent = backpack.Gear.GearLoadouts.GearLoadoutsScrollingArea


-- Begin Functions
function removeFromMap(map,object)
	for i = 1, #map do
		if map[i] == object then
			table.remove(map,i)
			break
		end
	end
end

function robloxLock(instance)
  instance.RobloxLocked = true
  children = instance:GetChildren()
  if children then
	 for i, child in ipairs(children) do
		robloxLock(child)
	 end
  end
end

function resize()
	local size = 0
	if gearPreview.AbsoluteSize.Y > gearPreview.AbsoluteSize.X then
		size = gearPreview.AbsoluteSize.X * 0.75
	else
		size = gearPreview.AbsoluteSize.Y * 0.75
	end

	gearPreview.GearImage.Size = UDim2.new(0,size,0,size)
	gearPreview.GearImage.Position = UDim2.new(0,gearPreview.AbsoluteSize.X/2 - size/2,0.75,-size)
	
	resizeGrid()
end

function addToGrid(child)
	if not child:IsA("Tool") then
		if not child:IsA("HopperBin") then 
			return
		end
	end
	if child:FindFirstChild("RobloxBuildTool") then return end
	
	for i,v in pairs(backpackItems) do  -- check to see if we already have this gear registered
		if v == child then return end
	end

	table.insert(backpackItems,child)
	
	local changeCon = child.Changed:connect(function(prop)
		if prop == "Name" then
			if buttons[child] then
				if buttons[child].Image == "" then
					buttons[child].GearText.Text = child.Name
				end
			end
		end
	end)
	local ancestryCon = nil
	ancestryCon = child.AncestryChanged:connect(function(theChild,theParent)
		local thisObject = nil
		for k,v in pairs(backpackItems) do
			if v == child then
				thisObject = v
				break
			end
		end
		
		waitForProperty(player,"Character")
		waitForChild(player,"Backpack")
		if (child.Parent ~= player.Backpack and child.Parent ~= player.Character) then
			if ancestryCon then ancestryCon:disconnect() end
			if changeCon then changeCon:disconnect() end
			
			for k,v in pairs(backpackItems) do
				if v == thisObject then
					if mouseEnterCons[buttons[v]] then mouseEnterCons[buttons[v]]:disconnect() end
					if mouseClickCons[buttons[v]] then mouseClickCons[buttons[v]]:disconnect() end
					buttons[v].Parent = nil
					buttons[v] = nil
					break
				end
			end

			removeFromMap(backpackItems,thisObject)
			
			resizeGrid()
		else
			resizeGrid()
		end
		updateGridActive()
	end)
	resizeGrid()
end

function buttonClick(button)
	if button:FindFirstChild("UnequipContextMenu") and not button.Active then
		button.UnequipContextMenu.Visible = true
		browsingMenu = true
	end
end

function previewGear(button)
	if not browsingMenu then
		gearPreview.GearImage.Image = button.Image
		gearPreview.GearStats.GearName.Text = button.GearReference.Value.Name
	end
end

function checkForSwap(button,x,y)
	local loadoutChildren = currentLoadout:GetChildren()
	for i = 1, #loadoutChildren do
		if loadoutChildren[i]:IsA("Frame") and string.find(loadoutChildren[i].Name,"Slot") then
			if x >= loadoutChildren[i].AbsolutePosition.x and x <= (loadoutChildren[i].AbsolutePosition.x + loadoutChildren[i].AbsoluteSize.x) then
				if y >= loadoutChildren[i].AbsolutePosition.y and y <= (loadoutChildren[i].AbsolutePosition.y + loadoutChildren[i].AbsoluteSize.y) then
					local slot = tonumber(string.sub(loadoutChildren[i].Name,5))
					swapGearSlot(slot,button)
					return true
				end
			end
		end
	end
	return false
end

function resizeGrid()
	for k,v in pairs(backpackItems) do
		if not v:FindFirstChild("RobloxBuildTool") then
			if not buttons[v] then
				local buttonClone = gearButton:clone()
				buttonClone.Parent = grid.ScrollingFrame
				buttonClone.Visible = true
				buttonClone.Image = v.TextureId
				if buttonClone.Image == "" then
					buttonClone.GearText.Text = v.Name
				end
				--print("v =",v)
				buttonClone.GearReference.Value = v
				buttonClone.Draggable = true 
				buttons[v] = buttonClone
				
				local unequipMenu = getGearContextMenu()
				
				unequipMenu.Visible = false
				unequipMenu.Parent = buttonClone
				
				local beginPos = nil
				buttonClone.DragBegin:connect(function(value)
					buttonClone.ZIndex = 9
					beginPos = value
				end)
				buttonClone.DragStopped:connect(function(x,y)
					if beginPos ~= buttonClone.Position then
						buttonClone.ZIndex = 1
						if not checkForSwap(buttonClone,x,y) then
							buttonClone:TweenPosition(beginPos,Enum.EasingDirection.Out, Enum.EasingStyle.Quad, 0.5, true)
							buttonClone.Draggable = false
							delay(0.5,function()
								buttonClone.Draggable = true
							end)
						else
							buttonClone.Position = beginPos
						end
					end	
				end)
				
				mouseEnterCons[buttonClone] = buttonClone.MouseEnter:connect(function() previewGear(buttonClone) end)
				mouseClickCons[buttonClone] = buttonClone.MouseButton1Click:connect(function() buttonClick(buttonClone) end)
			end
		end
	end
	recalculateScroll()
end

function showPartialGrid(subset)

	resetFrame.Visible = true

	for k,v in pairs(buttons) do
		v.Parent = nil
	end
	for k,v in pairs(subset) do
		v.Parent =  grid.ScrollingFrame
	end
	recalculateScroll()
end

function showEntireGrid()
	resetFrame.Visible = false
	
	for k,v in pairs(buttons) do
		v.Parent = grid.ScrollingFrame
	end
	recalculateScroll()
end

function inLoadout(gear)
	local children = currentLoadout:GetChildren()
	for i = 1, #children do
		if children[i]:IsA("Frame") then
			local button = children[i]:GetChildren()
			if #button > 0 then
				if button[1].GearReference.Value and button[1].GearReference.Value == gear then
					return true
				end
			end
		end
	end
	return false
end	

function updateGridActive()
	for k,v in pairs(backpackItems) do
		if buttons[v] then
			local gear = nil
			local gearRef = buttons[v]:FindFirstChild("GearReference")
			
			if gearRef then gear = gearRef.Value end
			
			if not gear then
				buttons[v].Active = false
			elseif inLoadout(gear) then
				buttons[v].Active = false
			else
				buttons[v].Active = true
			end
		end
	end
end

function centerGear(loadoutChildren)
	local gearButtons = {}
	local lastSlotAdd = nil
	for i = 1, #loadoutChildren do
		if loadoutChildren[i]:IsA("Frame") and #loadoutChildren[i]:GetChildren() > 0 then
			if loadoutChildren[i].Name == "Slot0" then 
				lastSlotAdd = loadoutChildren[i]
			else
				table.insert(gearButtons, loadoutChildren[i])
			end
		end
	end
	if lastSlotAdd then table.insert(gearButtons,lastSlotAdd) end
	
	local startPos = ( 1 - (#gearButtons * 0.1) ) / 2
	for i = 1, #gearButtons do	
		gearButtons[i]:TweenPosition(UDim2.new(startPos + ((i - 1) * 0.1),0,0,0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, 0.25, true)
	end
end

function spreadOutGear(loadoutChildren)
	for i = 1, #loadoutChildren do
		if loadoutChildren[i]:IsA("Frame") then
			local slot = tonumber(string.sub(loadoutChildren[i].Name,5))
			if slot == 0 then slot = 10 end
			loadoutChildren[i]:TweenPosition(UDim2.new((slot - 1)/10,0,0,0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, 0.25, true)
		end
	end
end

function openCloseBackpack()
	if openCloseDebounce then return end
	openCloseDebounce = true
	
	local visible = not backpack.Visible
	if visible then
		updateGridActive()
		local centerDialogSupported, msg = pcall(function() game.GuiService:AddCenterDialog(backpack, Enum.CenterDialogType.PlayerInitiatedDialog, 
			function()
				backpack.Visible = true
				loadoutChildren = currentLoadout:GetChildren()
				for i = 1, #loadoutChildren do
					if loadoutChildren[i]:IsA("Frame") then
						loadoutChildren[i].BackgroundTransparency = 0.5
					end
				end 
				spreadOutGear(loadoutChildren)
			end)
		end)
		backpackButton.Selected = true
		backpack:TweenSizeAndPosition(UDim2.new(0.55, 0, 0.6, 0),UDim2.new(0.225, 0, 0.2, 0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, guiTweenSpeed/2, true)
		delay(guiTweenSpeed/2 + 0.01,
			function()
				local children = backpack:GetChildren()
				for i = 1, #children do
					if children[i]:IsA("Frame") then
						children[i].Visible = true
					end
				end
				resizeGrid()
				resize()
				openCloseDebounce = false
			end)
	else
		backpackButton.Selected = false
		local children = backpack:GetChildren()
		for i = 1, #children do
			if children[i]:IsA("Frame") then
				children[i].Visible = false
			end
		end
		loadoutChildren = currentLoadout:GetChildren()
		for i = 1, #loadoutChildren do
			if loadoutChildren[i]:IsA("Frame") then
				loadoutChildren[i].BackgroundTransparency = 1
			end
		end
		centerGear(loadoutChildren)
	
		backpack:TweenSizeAndPosition(UDim2.new(0,0,0,0),UDim2.new(0.5,0,0.5,0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, guiTweenSpeed/2, true)
		delay(guiTweenSpeed/2 + 0.01,
			function()
				backpack.Visible = visible
				resizeGrid()
				resize()
				pcall(function() game.GuiService:RemoveCenterDialog(backpack) end)
				openCloseDebounce = false
			end)
	end
end

function loadoutCheck(child, selectState)
	if not child:IsA("ImageButton") then return end
	for k,v in pairs(backpackItems) do
		if buttons[v] then
			if child:FindFirstChild("GearReference") then
				if buttons[v].GearReference.Value == child.GearReference.Value then
					buttons[v].Active = selectState
					break
				end
			end
		end
	end
end

function clearPreview()
	gearPreview.GearImage.Image = ""
	gearPreview.GearStats.GearName.Text = ""
end

function removeAllEquippedGear(physGear)
	local stuff = player.Character:GetChildren()
	for i = 1, #stuff do
		if ( stuff[i]:IsA("Tool") or stuff[i]:IsA("HopperBin") ) and stuff[i] ~= physGear then
			stuff[i].Parent = playerBackpack
		end
	end
end

function equipGear(physGear)
	removeAllEquippedGear(physGear)
	physGear.Parent = player.Character
	updateGridActive()
end

function unequipGear(physGear)
	physGear.Parent = playerBackpack
	updateGridActive()
end

function highlight(button)
	button.TextColor3 = Color3.new(0,0,0)
	button.BackgroundColor3 = Color3.new(0.8,0.8,0.8)
end
function clearHighlight(button)
	button.TextColor3 = Color3.new(1,1,1)
	button.BackgroundColor3 = Color3.new(0,0,0)
end

function swapGearSlot(slot,gearButton)
	if not swapSlot.Value then -- signal loadout to swap a gear out
		swapSlot.Slot.Value = slot
		swapSlot.GearButton.Value = gearButton
		swapSlot.Value = true
		updateGridActive()
	end
end


local UnequipGearMenuClick = function(element, menu)
	if type(element.Action) ~= "number" then return end
	local num = element.Action
	if num == 1 then -- remove from loadout
		unequipGear(menu.Parent.GearReference.Value)
		local inventoryButton = menu.Parent
		local gearToUnequip = inventoryButton.GearReference.Value
		local loadoutChildren = currentLoadout:GetChildren()
		local slot = -1
		for i = 1, #loadoutChildren do
			if loadoutChildren[i]:IsA("Frame") then
				local button = loadoutChildren[i]:GetChildren()
				if button[1] and button[1].GearReference.Value == gearToUnequip then
					slot = button[1].SlotNumber.Text
					break
				end
			end
		end
		swapGearSlot(slot,nil)
	end
end

-- these next two functions are used to stop any use of backpack while the player is dead (can cause issues)
function activateBackpack()
	backpack.Visible = backpackOldStateVisible
	
	backpackButtonClickCon = backpackButton.MouseButton1Click:connect(function() openCloseBackpack() end)
	guiServiceKeyPressCon = game:GetService("GuiService").KeyPressed:connect(function(key)
		if key == tilde or key == backquote then
			openCloseBackpack()
		end
	end)
end
function deactivateBackpack()
	if backpackButtonClickCon then backpackButtonClickCon:disconnect() end
	if guiServiceKeyPressCon then guiServiceKeyPressCon:disconnect() end

	backpackOldStateVisible = backpack.Visible
	backpack.Visible = false
end

function setupCharacterConnections()

	if backpackAddCon then backpackAddCon:disconnect() end
	backpackAddCon = game.Players.LocalPlayer.Backpack.ChildAdded:connect(function(child) addToGrid(child) end)
	
	-- make sure we get all the children
	local backpackChildren = game.Players.LocalPlayer.Backpack:GetChildren()
	for i = 1, #backpackChildren do
		addToGrid(backpackChildren[i])
	end

	if characterChildAddedCon then characterChildAddedCon:disconnect() end
	characterChildAddedCon = 
		game.Players.LocalPlayer.Character.ChildAdded:connect(function(child)
			addToGrid(child)
			updateGridActive()
		end)
		
	if characterChildRemovedCon then characterChildRemovedCon:disconnect() end
	characterChildRemovedCon = 
		game.Players.LocalPlayer.Character.ChildRemoved:connect(function(child)
			updateGridActive()
		end)
		
			
	if humanoidDiedCon then humanoidDiedCon:disconnect() end
	local localPlayer = game.Players.LocalPlayer
	waitForProperty(localPlayer,"Character")
	waitForChild(localPlayer.Character,"Humanoid")
	humanoidDiedCon = game.Players.LocalPlayer.Character.Humanoid.Died:connect(function() deactivateBackpack() end)
	
	activateBackpack()
end

function removeCharacterConnections()
	if characterChildAddedCon then characterChildAddedCon:disconnect() end
	if characterChildRemovedCon then characterChildRemovedCon:disconnect() end
	if backpackAddCon then backpackAddCon:disconnect() end
end

function trim(s)
  return (s:gsub("^%s*(.-)%s*$", "%1"))
end

function splitByWhiteSpace(text)
	if type(text) ~= "string" then return nil end
	
	local terms = {}
	for token in string.gmatch(text, "[^%s]+") do
	   if string.len(token) > 2 then
			table.insert(terms,token)
	   end
	end
	return terms
end

function filterGear(searchTerm)
	string.lower(searchTerm)
	searchTerm = trim(searchTerm)
	if string.len(searchTerm) < 2 then return nil end
	local terms = splitByWhiteSpace(searchTerm)
	
	local filteredGear = {}
	for k,v in pairs(backpackItems) do
		if buttons[v] then
			local gearString = string.lower(buttons[v].GearReference.Value.Name)
			gearString = trim(gearString)
			for i = 1, #terms do
				if string.match(gearString,terms[i]) then
					table.insert(filteredGear,buttons[v])
					break
				end
			end
		end
	end
	
	return filteredGear
end


function showSearchGear()
	local searchText = searchBox.Text
	searchBox.Text = "Search..."
	local filteredButtons = filterGear(searchText)
	if filteredButtons and #filteredButtons > 0 then
		showPartialGrid(filteredButtons)
	else
		showEntireGrid()
	end
end

function nukeBackpack()
	while #buttons > 0 do
		table.remove(buttons)
	end
	buttons = {}
	while #backpackItems > 0 do
		table.remove(backpackItems)
	end
	backpackItems = {}
	local scrollingFrameChildren = grid.ScrollingFrame:GetChildren()
	for i = 1, #scrollingFrameChildren do
		scrollingFrameChildren[i]:remove()
	end
end

function getGearContextMenu()
	local gearContextMenu = Instance.new("Frame")
	gearContextMenu.Active = true
	gearContextMenu.Name = "UnequipContextMenu"
	gearContextMenu.Size = UDim2.new(0,115,0,70)
	gearContextMenu.Position = UDim2.new(0,-16,0,-16)
	gearContextMenu.BackgroundTransparency = 1
	gearContextMenu.Visible = false

	local gearContextMenuButton = Instance.new("TextButton")
	gearContextMenuButton.Name = "UnequipContextMenuButton"
	gearContextMenuButton.Text = ""
	gearContextMenuButton.Style = Enum.ButtonStyle.RobloxButtonDefault
	gearContextMenuButton.ZIndex = 4
	gearContextMenuButton.Size = UDim2.new(1, 0, 1, -20)
	gearContextMenuButton.Visible = true
	gearContextMenuButton.Parent = gearContextMenu
	
	local elementHeight = 12
	
	local contextMenuElements = {}		
	local contextMenuElementsName = {"Remove Hotkey"}

	for i = 1, #contextMenuElementsName do
		local element = {}
		element.Type = "Button"
		element.Text = contextMenuElementsName[i]
		element.Action = i
		element.DoIt = UnequipGearMenuClick
		table.insert(contextMenuElements,element)
	end

	for i, contextElement in ipairs(contextMenuElements) do
		local element = contextElement
		if element.Type == "Button" then
			local button = Instance.new("TextButton")
			button.Name = "UnequipContextButton" .. i
			button.BackgroundColor3 = Color3.new(0,0,0)
			button.BorderSizePixel = 0
			button.TextXAlignment = Enum.TextXAlignment.Left
			button.Text = " " .. contextElement.Text
			button.Font = Enum.Font.Arial
			button.FontSize = Enum.FontSize.Size14
			button.Size = UDim2.new(1, 8, 0, elementHeight)
			button.Position = UDim2.new(0,0,0,elementHeight * i)
			button.TextColor3 = Color3.new(1,1,1)
			button.ZIndex = 4
			button.Parent = gearContextMenuButton

			button.MouseButton1Click:connect(function()
				if button.Active and not gearContextMenu.Parent.Active then
					local success, result = pcall(function() element.DoIt(element, gearContextMenu) end)
					browsingMenu = false
					gearContextMenu.Visible = false
					clearHighlight(button)
					clearPreview()
				end
			end)
			
			button.MouseEnter:connect(function()
				if button.Active and gearContextMenu.Parent.Active then
					highlight(button)
				end
			end)
			button.MouseLeave:connect(function()
				if button.Active and gearContextMenu.Parent.Active then
					clearHighlight(button)
				end
			end)
			
			contextElement.Button = button
			contextElement.Element = button
		elseif element.Type == "Label" then
			local frame = Instance.new("Frame")
			frame.Name = "ContextLabel" .. i
			frame.BackgroundTransparency = 1
			frame.Size = UDim2.new(1, 8, 0, elementHeight)

			local label = Instance.new("TextLabel")	
			label.Name = "Text1"
			label.BackgroundTransparency = 1
			label.BackgroundColor3 = Color3.new(1,1,1)
			label.BorderSizePixel = 0
			label.TextXAlignment = Enum.TextXAlignment.Left
			label.Font = Enum.Font.ArialBold
			label.FontSize = Enum.FontSize.Size14
			label.Position = UDim2.new(0.0, 0, 0, 0)
			label.Size = UDim2.new(0.5, 0, 1, 0)
			label.TextColor3 = Color3.new(1,1,1)
			label.ZIndex = 4
			label.Parent = frame
			element.Label1 = label
		
			if element.GetText2 then
				label = Instance.new("TextLabel")	
				label.Name = "Text2"
				label.BackgroundTransparency = 1
				label.BackgroundColor3 = Color3.new(1,1,1)
				label.BorderSizePixel = 0
				label.TextXAlignment = Enum.TextXAlignment.Right
				label.Font = Enum.Font.Arial
				label.FontSize = Enum.FontSize.Size14
				label.Position = UDim2.new(0.5, 0, 0, 0)
				label.Size = UDim2.new(0.5, 0, 1, 0)
				label.TextColor3 = Color3.new(1,1,1)
				label.ZIndex = 4
				label.Parent = frame
				element.Label2 = label
			end
			frame.Parent = gearContextMenuButton
			element.Label = frame
			element.Element =  frame
		end
	end

	gearContextMenu.ZIndex = 4
	gearContextMenu.MouseLeave:connect(function()
		browsingMenu = false
		gearContextMenu.Visible = false
		clearPreview()
	end)
	robloxLock(gearContextMenu)
	
	return gearContextMenu
end

local backpackChildren = player.Backpack:GetChildren()
for i = 1, #backpackChildren do
	addToGrid(backpackChildren[i])
end

------------------------- Start Lifelong Connections -----------------------
screen.Changed:connect(function(prop)
	if prop == "AbsoluteSize" then
		if debounce then return end
		debounce = true
		wait()
		resize()
		resizeGrid()
		debounce = false
	end
end)

currentLoadout.ChildAdded:connect(function(child) loadoutCheck(child, false) end)
currentLoadout.ChildRemoved:connect(function(child) loadoutCheck(child, true) end)

currentLoadout.DescendantAdded:connect(function(descendant)
	if not backpack.Visible and ( descendant:IsA("ImageButton") or descendant:IsA("TextButton") ) then
		centerGear(currentLoadout:GetChildren())
	end
end)
currentLoadout.DescendantRemoving:connect(function(descendant)
	if not backpack.Visible and ( descendant:IsA("ImageButton") or descendant:IsA("TextButton") ) then
		wait()
		centerGear(currentLoadout:GetChildren())
	end
end)
	
grid.MouseEnter:connect(function() clearPreview() end)
grid.MouseLeave:connect(function() clearPreview() end)

player.CharacterRemoving:connect(function()
	removeCharacterConnections()
	nukeBackpack()
end)
player.CharacterAdded:connect(function() setupCharacterConnections() end)

player.ChildAdded:connect(function(child)
	if child:IsA("Backpack") then
		playerBackpack = child
		if backpackAddCon then backpackAddCon:disconnect() end
		backpackAddCon = game.Players.LocalPlayer.Backpack.ChildAdded:connect(function(child) addToGrid(child) end)
	end
end)

swapSlot.Changed:connect(function()
	if not swapSlot.Value then
		updateGridActive()
	end
end)

searchBox.FocusLost:connect(function(enterPressed)
	if enterPressed then
		showSearchGear()
	end
end)

local loadoutChildren = currentLoadout:GetChildren()
for i = 1, #loadoutChildren do
	if loadoutChildren[i]:IsA("Frame") and string.find(loadoutChildren[i].Name,"Slot") then
		loadoutChildren[i].ChildRemoved:connect(function()
			updateGridActive()
		end)
		loadoutChildren[i].ChildAdded:connect(function()
			updateGridActive()
		end)
	end
end

closeButton.MouseButton1Click:connect(function() openCloseBackpack() end)

searchButton.MouseButton1Click:connect(function() showSearchGear() end)
resetButton.MouseButton1Click:connect(function() showEntireGrid() end)
------------------------- End Lifelong Connections -----------------------

resize()
resizeGrid()

-- make sure any items in the loadout are accounted for in inventory
local loadoutChildren = currentLoadout:GetChildren()
for i = 1, #loadoutChildren do
	loadoutCheck(loadoutChildren[i], false)
end
if not backpack.Visible then centerGear(currentLoadout:GetChildren()) end

-- make sure that inventory is listening to gear reparenting
if characterChildAddedCon == nil and game.Players.LocalPlayer["Character"] then
	setupCharacterConnections()
end
if not backpackAddCon then
	backpackAddCon = game.Players.LocalPlayer.Backpack.ChildAdded:connect(function(child) addToGrid(child) end)
end

-- flip it on if we are good
if game.CoreGui.Version >= 3 then
	backpackButton.Visible = true
end

recalculateScrollLoadout()

end)

showServerNotifications = true

pcall(function() settings().Diagnostics:LegacyScriptMode() end)
pcall(function() game:GetService("ScriptContext").ScriptsDisabled = false end)

--function made by rbxbanland
function newWaitForChild(newParent,name)
	local returnable = nil
	if newParent:FindFirstChild(name) then
		returnable = newParent:FindFirstChild(name)
	else 
		repeat wait() returnable = newParent:FindFirstChild(name)  until returnable ~= nil
	end
	return returnable
end

function KickPlayer(Player,reason)
	if (game.Lighting:FindFirstChild("SkipSecurity") ~= nil) then
		do return end
	end
	
	Server = game:GetService("NetworkServer")

	if (Player ~= nil) then
		for _,Child in pairs(Server:children()) do
			name = "ServerReplicator|"..Player.Name.."|"..Player.userId.."|"..Player.AnonymousIdentifier.Value
			if (Server:findFirstChild(name) ~= nil) then
				Child:CloseConnection()
			end
		end
	end
end

function newWaitForChildSecurity(newParent,name)
	local returnable = nil
	local loadAttempts = 0
	local maxAttempts = 5
	while loadAttempts < maxAttempts do
		if newParent:FindFirstChild(name) then
			returnable = newParent:FindFirstChild(name)
			break
		end
		--for 2011+ to work the same way as other clients, we need to add half a second of wait time.
		wait(0.5)
		loadAttempts = loadAttempts + 1
		print("Player '" .. newParent.Name .. "' trying to connect. Number of attempts: "..loadAttempts)
	end
		
	if (loadAttempts == maxAttempts) then
		KickPlayer(newParent, "Modified Client")
	end
		
	return returnable
end

function LoadCharacterNew(playerApp,newChar)
	PlayerService = game:GetService("Players")
	Player = PlayerService:GetPlayerFromCharacter(newChar)
	
	local function kick()
		KickPlayer(Player, "Modified Client")
	end
	
	if (playerApp == nil) then
		kick()
	end
	
	if (not Player:FindFirstChild("Appearance")) then
		kick()
	end
	
	if ((playerApp:GetChildren() == 0) or (playerApp:GetChildren() == nil)) then
		kick()
	end
	
	local path = "rbxasset://../../../shareddata/charcustom/"

	local charparts = {[1] = newWaitForChild(newChar,"Head"),[2] = newWaitForChild(newChar,"Torso"),[3] = newWaitForChild(newChar,"Left Arm"),[4] = newWaitForChild(newChar,"Right Arm"),[5] = newWaitForChild(newChar,"Left Leg"),[6] = newWaitForChild(newChar,"Right Leg")}
	for _,newVal in pairs(playerApp:GetChildren()) do
		local customtype = newVal.CustomizationType.Value
		if (customtype == 1) then 
			pcall(function() 
				charparts[newVal.ColorIndex.Value].BrickColor = newVal.Value 
			end)
		elseif (customtype == 2)  then
			pcall(function()
				local newHat = game.Workspace:InsertContent(path.."hats/"..newVal.Value)
				if newHat[1] then 
					if newHat[1].className == "Hat" then
						newHat[1].Parent = newChar
					else
						newHat[1]:remove()
					end
				end
			end)
		elseif (customtype == 3)  then
			pcall(function()
				local newTShirt = "";
				if (string.match(newVal.Value, "http") == "http") then
					if (pcall(function()
						newTShirt = game.Workspace:InsertContent(newVal.Value)
						if newTShirt[1] then 
							if newTShirt[1].className == "ShirtGraphic" then
								newTShirt[1].Parent = newChar
								local oldTexture = newTShirt[1].Graphic;
								OldURL,OldID = oldTexture:match("(.+)=(.+)")
								NewURL,NewID = newVal.Value:match("(.+)=(.+)")
								newTShirt[1].Graphic = NewURL .. '=' .. OldID
							else
								newTShirt[1]:remove()
							end
						end
					end)) then
						--nothing
						print("success");
					else
						print("fail");
						newTShirt = Instance.new("ShirtGraphic")
						newTShirt.Graphic = newVal.Value
						newTShirt.Parent = newChar
					end
				else
					newTShirt = game.Workspace:InsertContent(path.."tshirts/"..newVal.Value)
					if newTShirt[1] then 
						if newTShirt[1].className == "ShirtGraphic" then
							newTShirt[1].Parent = newChar
						else
							newTShirt[1]:remove()
						end
					end
				end
			end)
		elseif (customtype == 4)  then
			pcall(function()
				local newShirt = "";
				if (string.match(newVal.Value, "http") == "http") then
					if (pcall(function()
						newShirt = game.Workspace:InsertContent(newVal.Value)
						if newShirt[1] then 
							if newShirt[1].className == "Shirt" then
								newShirt[1].Parent = newChar
								local oldTexture = newShirt[1].ShirtTemplate;
								OldURL,OldID = oldTexture:match("(.+)=(.+)")
								NewURL,NewID = newVal.Value:match("(.+)=(.+)")
								newShirt[1].ShirtTemplate = NewURL .. '=' .. OldID
							else
								newShirt[1]:remove()
							end
						end
					end)) then
						--nothing
						print("success");
					else
						print("fail");
						newShirt = Instance.new("Shirt")
						newShirt.ShirtTemplate = newVal.Value
						newShirt.Parent = newChar
					end
				else
					newShirt = game.Workspace:InsertContent(path.."shirts/"..newVal.Value)
					if newShirt[1] then 
						if newShirt[1].className == "Shirt" then
							newShirt[1].Parent = newChar
						else
							newShirt[1]:remove()
						end
					end
				end
			end)
		elseif (customtype == 5)  then
			pcall(function()
				local newPants = "";
				if (string.match(newVal.Value, "http") == "http") then
					if (pcall(function()
						newPants = game.Workspace:InsertContent(newVal.Value)
						if newPants[1] then 
							if newPants[1].className == "Pants" then
								newPants[1].Parent = newChar
								local oldTexture = newPants[1].PantsTemplate;
								OldURL,OldID = oldTexture:match("(.+)=(.+)")
								NewURL,NewID = newVal.Value:match("(.+)=(.+)")
								newPants[1].PantsTemplate = NewURL .. '=' .. OldID
							else
								newPants[1]:remove()
							end
						end
					end)) then
						--nothing
						print("success");
					else
						print("fail");
						newPants = Instance.new("Pants")
						newPants.PantsTemplate = newVal.Value
						newPants.Parent = newChar
					end
				else
					newPants = game.Workspace:InsertContent(path.."pants/"..newVal.Value)
					if newPants[1] then 
						if newPants[1].className == "Pants" then
							newPants[1].Parent = newChar
						else
							newPants[1]:remove()
						end
					end
				end
			end)
		elseif (customtype == 6)  then
			pcall(function()
				local newFace = "";
				if (string.match(newVal.Value, "http") == "http") then
					if (pcall(function()
						newFace = game.Workspace:InsertContent(newVal.Value)
						if newFace[1] then 
							if newFace[1].className == "Decal" then
								newWaitForChild(charparts[1],"face"):remove()
								newFace[1].Parent = charparts[1]
								newFace[1].Face = "Front"
								local oldTexture = newFace[1].Texture;
								OldURL,OldID = oldTexture:match("(.+)=(.+)")
								NewURL,NewID = newVal.Value:match("(.+)=(.+)")
								newFace[1].Texture = NewURL .. '=' .. OldID
							else
								newFace[1]:remove()
							end
						end
					end)) then
						--nothing
						print("success");
					else
						print("fail");
						newWaitForChild(charparts[1],"face"):remove()
						newFace = Instance.new("Decal")
						newFace.Texture = newVal.Value
						newFace.Face = "Front"
						newFace.Parent = charparts[1]
					end
				else
					newFace = game.Workspace:InsertContent(path.."faces/"..newVal.Value)
					if newFace[1] then 
						if newFace[1].className == "Decal" then
							newWaitForChild(charparts[1],"face"):remove()
							newFace[1].Parent = charparts[1]
							newFace[1].Face = "Front"
						else
							newFace[1]:remove()
						end
					end
				end
			end)
		elseif (customtype == 7)  then
			pcall(function()
				local newPart = game.Workspace:InsertContent(path.."heads/"..newVal.Value)
				if newPart[1] then 
					if newPart[1].className == "SpecialMesh" or newPart[1].className == "CylinderMesh" or newPart[1].className == "BlockMesh" then
						newWaitForChild(charparts[1],"Mesh"):remove()
						newPart[1].Parent = charparts[1]
					else
						newPart[1]:remove()
					end
				end
			end)
		elseif (customtype == 8)  then
			pcall(function()
				local newHat = game.Workspace:InsertContent(path.."hats/"..newVal.Value)
				if newHat[1] then 
					if newHat[1].className == "Hat" then
						newHat[1].Parent = newChar
					else
						newHat[1]:remove()
					end
				end
			end)
			
			pcall(function()
				local newItem = game.Workspace:InsertContent(path.."custom/"..newVal.Value)
				if newItem[1] then 
					if newItem[1].className == "Decal" then
						newWaitForChild(charparts[1],"face"):remove()
						newItem[1].Parent = charparts[1]
						newItem[1].Face = "Front"
					elseif newPart[1].className == "SpecialMesh" or newPart[1].className == "CylinderMesh" or newPart[1].className == "BlockMesh" then
						newWaitForChild(charparts[1],"Mesh"):remove()
						newItem[1].Parent = charparts[1]
					else
						newItem[1].Parent = newChar
					end
				end
			end)
		end
	end
end

function InitalizeClientAppearance(Player,Hat1ID,Hat2ID,Hat3ID,HeadColorID,TorsoColorID,LeftArmColorID,RightArmColorID,LeftLegColorID,RightLegColorID,TShirtID,ShirtID,PantsID,FaceID,HeadID,ItemID)
	local newCharApp = Instance.new("IntValue",Player)
	newCharApp.Name = "Appearance"
	--BODY COLORS
	for i=1,6,1 do
		local BodyColor = Instance.new("BrickColorValue",newCharApp)
		if (i == 1) then
			if (HeadColorID ~= nil) then
				BodyColor.Value = BrickColor.new(HeadColorID)
			else
				BodyColor.Value = BrickColor.new(1)
			end
			BodyColor.Name = "Head Color"
		elseif (i == 2) then
			if (TorsoColorID ~= nil) then
				BodyColor.Value = BrickColor.new(TorsoColorID)
			else
				BodyColor.Value = BrickColor.new(1)
			end
			BodyColor.Name = "Torso Color"
		elseif (i == 3) then
			if (LeftArmColorID ~= nil) then
				BodyColor.Value = BrickColor.new(LeftArmColorID)
			else
				BodyColor.Value = BrickColor.new(1)
			end
			BodyColor.Name = "Left Arm Color"
		elseif (i == 4) then
			if (RightArmColorID ~= nil) then
				BodyColor.Value = BrickColor.new(RightArmColorID)
			else
				BodyColor.Value = BrickColor.new(1)
			end
			BodyColor.Name = "Right Arm Color"
		elseif (i == 5) then
			if (LeftLegColorID ~= nil) then
				BodyColor.Value = BrickColor.new(LeftLegColorID)
			else
				BodyColor.Value = BrickColor.new(1)
			end
			BodyColor.Name = "Left Leg Color"
		elseif (i == 6) then
			if (RightLegColorID ~= nil) then
				BodyColor.Value = BrickColor.new(RightLegColorID)
			else
				BodyColor.Value = BrickColor.new(1)
			end
			BodyColor.Name = "Right Leg Color"
		end
		local indexValue = Instance.new("NumberValue")
		indexValue.Name = "ColorIndex"
		indexValue.Parent = BodyColor
		indexValue.Value = i
		local typeValue = Instance.new("NumberValue")
		typeValue.Name = "CustomizationType"
		typeValue.Parent = BodyColor
		typeValue.Value = 1
	end
	--HATS
	for i=1,3,1 do
		local newHat = Instance.new("StringValue",newCharApp)
		if (i == 1) then
			if (Hat1ID ~= nil) then
				newHat.Value = Hat1ID
				newHat.Name = "Hat 1 - "..Hat1ID
			else
				newHat.Value = "NoHat.rbxm"
				newHat.Name = "Hat 1 - NoHat.rbxm"
			end
		elseif (i == 2) then
			if (Hat2ID ~= nil) then
				newHat.Value = Hat2ID
				newHat.Name = "Hat 2 - "..Hat2ID
			else
				newHat.Value = "NoHat.rbxm"
				newHat.Name = "Hat 2 - NoHat.rbxm"
			end
		elseif (i == 3) then
			if (Hat3ID ~= nil) then
				newHat.Value = Hat3ID
				newHat.Name = "Hat 3 - "..Hat3ID
			else
				newHat.Value = "NoHat.rbxm"
				newHat.Name = "Hat 3 - NoHat.rbxm"
			end
		end
		local typeValue = Instance.new("NumberValue")
		typeValue.Name = "CustomizationType"
		typeValue.Parent = newHat
		typeValue.Value = 2
	end
	--T-SHIRT
	local newTShirt = Instance.new("StringValue",newCharApp)
	if (TShirtID ~= nil) then
		newTShirt.Value = TShirtID
		newTShirt.Name = "T-Shirt - "..TShirtID
	else
		newTShirt.Value = "NoTShirt.rbxm"
		newTShirt.Name = "T-Shirt - NoTShirt.rbxm"
	end
	local typeValue = Instance.new("NumberValue")
	typeValue.Name = "CustomizationType"
	typeValue.Parent = newTShirt
	typeValue.Value = 3
	--SHIRT
	local newShirt = Instance.new("StringValue",newCharApp)
	if (ShirtID ~= nil) then
		newShirt.Value = ShirtID
		newShirt.Name = "Shirt - "..ShirtID
	else
		newShirt.Value = "NoShirt.rbxm"
		newShirt.Name = "Shirt - NoShirt.rbxm"
	end
	local typeValue = Instance.new("NumberValue")
	typeValue.Name = "CustomizationType"
	typeValue.Parent = newShirt
	typeValue.Value = 4
	--PANTS
	local newPants = Instance.new("StringValue",newCharApp)
	if (PantsID ~= nil) then
		newPants.Value = PantsID
		newPants.Name = "Pants - "..PantsID
	else
		newPants.Value = "NoPants.rbxm"
		newPants.Name = "Pants - NoPants.rbxm"
	end
	local typeValue = Instance.new("NumberValue")
	typeValue.Name = "CustomizationType"
	typeValue.Parent = newPants
	typeValue.Value = 5
	--FACE
	local newFace = Instance.new("StringValue",newCharApp)
	if (FaceID ~= nil) then
		newFace.Value = FaceID
		newFace.Name = "Face - "..FaceID
	else
		newFace.Value = "DefaultFace.rbxm"
		newFace.Name = "Face - DefaultFace.rbxm"
	end
	local typeValue = Instance.new("NumberValue")
	typeValue.Name = "CustomizationType"
	typeValue.Parent = newFace
	typeValue.Value = 6
	--HEADS
	local newHead = Instance.new("StringValue",newCharApp)
	if (HeadID ~= nil) then
		newHead.Value = HeadID
		newHead.Name = "Head - "..HeadID
	else
		newHead.Value = "DefaultHead.rbxm"
		newHead.Name = "Head - DefaultHead.rbxm"
	end
	local typeValue = Instance.new("NumberValue")
	typeValue.Name = "CustomizationType"
	typeValue.Parent = newHead
	typeValue.Value = 7
	--EXTRA
	local newItem = Instance.new("StringValue",newCharApp)
	if (ItemID ~= nil) then
		newItem.Value = ItemID
		newItem.Name = "Extra - "..ItemID
	else
		newItem.Value = "NoExtra.rbxm"
		newItem.Name = "Extra - NoExtra.rbxm"
	end
	local typeValue = Instance.new("NumberValue")
	typeValue.Name = "CustomizationType"
	typeValue.Parent = newItem
	typeValue.Value = 8
end

function LoadSecurity(playerApp,Player,ServerSecurityLocation)
	local function kick()
		KickPlayer(Player, "Modified Client")
	end
	
	if (playerApp == nil) then
		kick()
	end
	
	if (not Player:FindFirstChild("Security")) then
		kick()
	end
	
	if (not playerApp:FindFirstChild("ClientEXEMD5") or not playerApp:FindFirstChild("LauncherMD5") or not playerApp:FindFirstChild("ClientScriptMD5") or not playerApp:FindFirstChild("ValidatedFiles")) then
		kick()
	end
	
	for _,newVal in pairs(playerApp:GetChildren()) do
		if (newVal.Name == "ClientEXEMD5") then
			if (newVal.Value ~= ServerSecurityLocation.Security.ClientEXEMD5.Value or newVal.Value == "") then
				kick()
				break
			end
		end
				
		if (newVal.Name == "LauncherMD5") then
			if (newVal.Value ~= ServerSecurityLocation.Security.LauncherMD5.Value or newVal.Value == "") then
				kick()
				break
			end
		end
				
		if (newVal.Name == "ClientScriptMD5") then
			if (newVal.Value ~= ServerSecurityLocation.Security.ClientScriptMD5.Value or newVal.Value == "") then
				kick()
				break
			end
		end
		
		if (newVal.Name == "ValidatedFiles") then
			if (newVal.Value ~= ServerSecurityLocation.Security.ValidatedFiles.Value or newVal.Value == "") then
				kick()
				break
			end
		end
	end
end

function InitalizeSecurityValues(Location,ClientEXEMD5,LauncherMD5,ClientScriptMD5,ValidatedScripts)
	Location = Instance.new("IntValue", Location)
	Location.Name = "Security"
	
	local clientValue = Instance.new("StringValue", Location)
	clientValue.Value = ClientEXEMD5 or ""
	clientValue.Name = "ClientEXEMD5"

	local launcherValue = Instance.new("StringValue", Location)
	launcherValue.Value = LauncherMD5 or ""
	launcherValue.Name = "LauncherMD5"

	local scriptValue = Instance.new("StringValue", Location)
	scriptValue.Value = ClientScriptMD5 or ""
	scriptValue.Name = "ClientScriptMD5"
	
	local validScriptValue = Instance.new("StringValue", Location)
	validScriptValue.Value = ValidatedScripts or "0"
	validScriptValue.Name = "ValidatedFiles"
end

function InitalizeTripcode(Location,Tripcode)
	local code = Instance.new("StringValue", Location)
	code.Value = Tripcode or ""
	code.Name = "Tripcode"
end

function LoadTripcode(Player)
	local function kick()
		KickPlayer(Player, "Modified Client")
	end
	
	if (not Player:FindFirstChild("Tripcode")) then
		kick()
	end
	
	for _,newVal in pairs(Player:GetChildren()) do
		if (newVal.Name == "Tripcode") then
			if (newVal.Value == "") then
				kick()
				break
			end
		end
	end
end

rbxversion = version()
print("ROBLOX Client version '" .. rbxversion .. "' loaded.")

function CSServer(Port,PlayerLimit,ClientEXEMD5,LauncherMD5,ClientScriptMD5,Notifications,ValidatedScripts)
	dofile("rbxasset://scripts\\cores\\StarterScriptServer.lua")
	assert((type(Port)~="number" or tonumber(Port)~=nil or Port==nil),"CSRun Error: Port must be nil or a number.")
	local NetworkServer=game:GetService("NetworkServer")
	local RunService = game:GetService("RunService")
	local PlayerService = game:GetService("Players")
	game:GetService("Visit"):SetUploadUrl("")
	showServerNotifications = Notifications
	pcall(NetworkServer.Stop,NetworkServer)
	NetworkServer:Start(Port)
	if (showServerNotifications) then
		PlayerService.MaxPlayers = PlayerLimit + 1
		--create a fake player to record connections and disconnections
		notifyPlayer = game:GetService("Players"):CreateLocalPlayer(-1)
		notifyPlayer.Name = "[SERVER]"
	else
		PlayerService.MaxPlayers = PlayerLimit
	end
	
	local playerCount = 0
	PlayerService.PlayerAdded:connect(function(Player)
		-- create anonymous player identifier. This is so we can track clients without tripcodes
		playerCount = playerCount + 1
		
		local code = Instance.new("StringValue", Player)
		code.Value = playerCount
		code.Name = "AnonymousIdentifier"
	
		-- rename all Server replicators in NetworkServer to "ServerReplicator"
		for _,Child in pairs(NetworkServer:children()) do
			if (Child:GetPlayer() == Player) then
				name = "ServerReplicator|"..Player.Name.."|"..Player.userId.."|"..Player.AnonymousIdentifier.Value
				if (NetworkServer:findFirstChild(name) == nil) then
					Child.Name = name
				end
			end
		end
		
		if (PlayerService.NumPlayers > PlayerService.MaxPlayers) then
			KickPlayer(Player, "Too many players on server.")
		else
			print("Player '" .. Player.Name .. "' with ID '" .. Player.userId .. "' added")
			if (showServerNotifications) then
				game.Players:Chat("Player '" .. Player.Name .. "' joined")
			end
			
			Player:LoadCharacter()
			
			LoadSecurity(newWaitForChildSecurity(Player,"Security"),Player,game.Lighting)
			newWaitForChildSecurity(Player,"Tripcode")
			LoadTripcode(Player)
			pcall(function() print("Player '" .. Player.Name .. "-" .. Player.userId .. "' security check success. Tripcode: '" .. Player.Tripcode.Value .. "'") end)
			if (Player.Character ~= nil) then
				LoadCharacterNew(newWaitForChildSecurity(Player,"Appearance"), Player.Character)
			end
		end
		
		Player.Changed:connect(function(Property)
			if (Player.Character~=nil) then
				local Character=Player.Character
				local Humanoid=Character:FindFirstChild("Humanoid")
				if (Humanoid~=nil) then
					Humanoid.Died:connect(function() delay(5,function() Player:LoadCharacter() LoadCharacterNew(newWaitForChildSecurity(Player,"Appearance"),Player.Character) end) end)
				end
			end
		end)
		
		Player.Chatted:connect(function(msg)
			print(Player.Name.."; "..msg)
		end)
	end)
	PlayerService.PlayerRemoving:connect(function(Player)
		print("Player '" .. Player.Name .. "' with ID '" .. Player.userId .. "' leaving")
		if (showServerNotifications) then
			game.Players:Chat("Player '" .. Player.Name .. "' left")
		end
	end)
	RunService:Run()
	game.Workspace:InsertContent("rbxasset://Fonts//libraries.rbxm")
	InitalizeSecurityValues(game.Lighting,ClientEXEMD5,LauncherMD5,ClientScriptMD5,ValidatedScripts)
	NetworkServer.IncommingConnection:connect(IncommingConnection)
	pcall(function() game.Close:connect(function() NetworkServer:Stop() end) end)
end

function CSConnect(UserID,ServerIP,ServerPort,PlayerName,Hat1ID,Hat2ID,Hat3ID,HeadColorID,TorsoColorID,LeftArmColorID,RightArmColorID,LeftLegColorID,RightLegColorID,TShirtID,ShirtID,PantsID,FaceID,HeadID,IconType,ItemID,ClientEXEMD5,LauncherMD5,ClientScriptMD5,Tripcode,ValidatedScripts,Ticket)
	dofile("rbxasset://scripts\\cores\\StarterScript.lua")
	pcall(function() game:SetPlaceID(-1, false) end)
	pcall(function() game:GetService("Players"):SetChatStyle(Enum.ChatStyle.ClassicAndBubble) end)
	game:GetService("RunService"):Run()
	assert((ServerIP~=nil and ServerPort~=nil),"CSConnect Error: ServerIP and ServerPort must be defined.")
	local function SetMessage(Message) game:SetMessage(Message) end
	local Visit,NetworkClient,PlayerSuccess,Player,ConnectionFailedHook=game:GetService("Visit"),game:GetService("NetworkClient")

	local function GetClassCount(Class,Parent)
		local Objects=Parent:GetChildren()
		local Number=0
		for Index,Object in pairs(Objects) do
			if (Object.className==Class) then
				Number=Number+1
			end
			Number=Number+GetClassCount(Class,Object)
		end
		return Number
	end

	local function RequestCharacter(Replicator)
		local Connection
		Connection=Player.Changed:connect(function(Property)
			if (Property=="Character") then
				game:ClearMessage()
			end
		end)
		SetMessage("Requesting character...")
		Replicator:RequestCharacter()
		SetMessage("Waiting for character...")
	end

	local function Disconnection(Peer,LostConnection)
		SetMessage("You have lost connection to the game")
	end

	local function ConnectionAccepted(Peer,Replicator)
		Replicator.Disconnection:connect(Disconnection)
		local RequestingMarker=true
		game:SetMessageBrickCount()
		local Marker=Replicator:SendMarker()
		Marker.Received:connect(function()
			RequestingMarker=false
			RequestCharacter(Replicator)
		end)
		while RequestingMarker do
			Workspace:ZoomToExtents()
			wait(0.5)
		end
	end

	local function ConnectionFailed(Peer, Code, why)
		SetMessage("Failed to connect to the Game. (ID="..Code..")")
	end

	pcall(function() settings().Diagnostics:LegacyScriptMode() end)
	pcall(function() game:SetRemoteBuildMode(true) end)
	SetMessage("Connecting to server...")
	NetworkClient.ConnectionAccepted:connect(ConnectionAccepted)
	ConnectionFailedHook=NetworkClient.ConnectionFailed:connect(ConnectionFailed)
	NetworkClient.ConnectionRejected:connect(function()
		pcall(function() ConnectionFailedHook:disconnect() end)
		SetMessage("Failed to connect to the Game. (Connection rejected)")
	end)

	pcall(function() NetworkClient.Ticket=Ticket or "" end) -- 2008 client has no ticket :O
	PlayerSuccess,Player=pcall(function() return NetworkClient:PlayerConnect(UserID,ServerIP,ServerPort) end)

	if (not PlayerSuccess) then
		SetMessage("Failed to connect to the Game. (Invalid IP Address)")
		NetworkClient:Disconnect()
	end

	if (not PlayerSuccess) then
		local Error,Message=pcall(function()
			Player=game:GetService("Players"):CreateLocalPlayer(UserID)
			NetworkClient:Connect(ServerIP,ServerPort)
		end)
		if (not Error) then
			SetMessage("Failed to connect to the Game.")
		end
	end
	
	pcall(function() Player.Name=PlayerName or "" end)
	pcall(function() Player:SetUnder13(false) end)
	pcall(function() Player:SetAccountAge(365) end)
	Player:SetSuperSafeChat(false)
	Player.CharacterAppearance=0
	game.GuiRoot.ScoreHud:Remove()
	if (IconType == "BC") then
		Player:SetMembershipType(Enum.MembershipType.BuildersClub)
	elseif (IconType == "TBC") then
		Player:SetMembershipType(Enum.MembershipType.TurboBuildersClub)
	elseif  (IconType == "OBC") then
		Player:SetMembershipType(Enum.MembershipType.OutrageousBuildersClub)
	elseif  (IconType == "NBC") then
		Player:SetMembershipType(Enum.MembershipType.None)
	end
	
	pcall(function() Visit:SetUploadUrl("") end)
	InitalizeClientAppearance(Player,Hat1ID,Hat2ID,Hat3ID,HeadColorID,TorsoColorID,LeftArmColorID,RightArmColorID,LeftLegColorID,RightLegColorID,TShirtID,ShirtID,PantsID,FaceID,HeadID,ItemID)
	InitalizeSecurityValues(Player,ClientEXEMD5,LauncherMD5,ClientScriptMD5,ValidatedScripts)
	InitalizeTripcode(Player,Tripcode)
end

function CSSolo(UserID,PlayerName,Hat1ID,Hat2ID,Hat3ID,HeadColorID,TorsoColorID,LeftArmColorID,RightArmColorID,LeftLegColorID,RightLegColorID,TShirtID,ShirtID,PantsID,FaceID,HeadID,IconType,ItemID)
	dofile("rbxasset://scripts\\cores\\StarterScript.lua")
	game:GetService("RunService"):Run()
	local plr = game.Players:CreateLocalPlayer(UserID)
	plr.Name = PlayerName
	plr:LoadCharacter()
	if (IconType == "BC") then
		plr:SetMembershipType(Enum.MembershipType.BuildersClub)
	elseif (IconType == "TBC") then
		plr:SetMembershipType(Enum.MembershipType.TurboBuildersClub)
	elseif  (IconType == "OBC") then
		plr:SetMembershipType(Enum.MembershipType.OutrageousBuildersClub)
	elseif  (IconType == "NBC") then
		plr:SetMembershipType(Enum.MembershipType.None)
	end
	game.GuiRoot.ScoreHud:Remove()
	plr.CharacterAppearance=0
	InitalizeClientAppearance(plr,Hat1ID,Hat2ID,Hat3ID,HeadColorID,TorsoColorID,LeftArmColorID,RightArmColorID,LeftLegColorID,RightLegColorID,TShirtID,ShirtID,PantsID,FaceID,HeadID,ItemID)
	wait(0.7)
	LoadCharacterNew(newWaitForChild(plr,"Appearance"),plr.Character,false)
	game.Workspace:InsertContent("rbxasset://Fonts//libraries.rbxm")
	game:GetService("Visit"):SetUploadUrl("")
	while true do 
		wait(0.001)
		if (plr.Character ~= nil) then
			print()
			if (plr.Character:findFirstChild("Humanoid") and (plr.Character.Humanoid.Health == 0)) then
				wait(5)
				plr:LoadCharacter()
				LoadCharacterNew(newWaitForChild(plr,"Appearance"),plr.Character)
			elseif (plr.Character.Parent == nil) then 
				wait(5)
				plr:LoadCharacter() -- to make sure nobody is deleted.
				LoadCharacterNew(newWaitForChild(plr,"Appearance"),plr.Character)
			end
		end
	end
end

function CSStudio()
	dofile("rbxasset://scripts\\cores\\StarterScript.lua")
end

_G.CSServer=CSServer
_G.CSConnect=CSConnect
_G.CSSolo=CSSolo
_G.CSStudio=CSStudio


delay(0, function()

function waitForProperty(instance, name)
	while not instance[name] do
		instance.Changed:wait()
	end
end

function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end


local mainFrame
local choices = {}
local lastChoice
local choiceMap = {}
local currentConversationDialog
local currentConversationPartner
local currentAbortDialogScript

local tooFarAwayMessage =           "You are too far away to chat!"
local tooFarAwaySize = 300
local characterWanderedOffMessage = "Chat ended because you walked away"
local characterWanderedOffSize = 350
local conversationTimedOut =        "Chat ended because you didn't reply"
local conversationTimedOutSize = 350

local player
local screenGui
local chatNotificationGui
local messageDialog
local timeoutScript
local reenableDialogScript
local dialogMap = {}
local dialogConnections = {}

local gui = nil
waitForChild(game,"CoreGui")
waitForChild(game.CoreGui,"RobloxGui")
if game.CoreGui.RobloxGui:FindFirstChild("ControlFrame") then
	gui = game.CoreGui.RobloxGui.ControlFrame
else
	gui = game.CoreGui.RobloxGui
end

function currentTone()
	if currentConversationDialog then
		return currentConversationDialog.Tone
	else
		return Enum.DialogTone.Neutral
	end
end
	

function createChatNotificationGui()
	chatNotificationGui = Instance.new("BillboardGui")
	chatNotificationGui.Name = "ChatNotificationGui"
	chatNotificationGui.ExtentsOffset = Vector3.new(0,1,0)
	chatNotificationGui.Size = UDim2.new(4, 0, 5.42857122, 0)
	chatNotificationGui.SizeOffset = Vector2.new(0,0)
	chatNotificationGui.StudsOffset = Vector3.new(0.4, 4.3, 0)
	chatNotificationGui.Enabled = true
   chatNotificationGui.RobloxLocked = true
	chatNotificationGui.Active = true

	local image = Instance.new("ImageLabel")
	image.Name = "Image"
	image.Active = false
	image.BackgroundTransparency = 1
	image.Position = UDim2.new(0,0,0,0)
	image.Size = UDim2.new(1.0,0,1.0,0)
	image.Image = ""
   image.RobloxLocked = true
	image.Parent = chatNotificationGui
   

	local button = Instance.new("ImageButton")
	button.Name = "Button"
	button.AutoButtonColor = false
	button.Position = UDim2.new(0.0879999995, 0, 0.0529999994, 0)
	button.Size = UDim2.new(0.829999983, 0, 0.460000008, 0)
	button.Image = ""
	button.BackgroundTransparency = 1
   button.RobloxLocked = true
	button.Parent = image
end

function getChatColor(tone)
	if tone == Enum.DialogTone.Neutral then
		return Enum.ChatColor.Blue
	elseif tone == Enum.DialogTone.Friendly then
		return Enum.ChatColor.Green
	elseif tone == Enum.DialogTone.Enemy then
		return Enum.ChatColor.Red
	end
end

function styleChoices(tone)
	for i, obj in pairs(choices) do
		resetColor(obj, tone)
	end
	resetColor(lastChoice, tone)
end

function styleMainFrame(tone)
	if tone == Enum.DialogTone.Neutral then
		mainFrame.Style = Enum.FrameStyle.ChatBlue
		mainFrame.Tail.Image = "rbxasset://textures/chatBubble_botBlue_tailRight.png"
	elseif tone == Enum.DialogTone.Friendly then
		mainFrame.Style = Enum.FrameStyle.ChatGreen
		mainFrame.Tail.Image = "rbxasset://textures/chatBubble_botGreen_tailRight.png"
	elseif tone == Enum.DialogTone.Enemy then
		mainFrame.Style = Enum.FrameStyle.ChatRed
		mainFrame.Tail.Image = "rbxasset://textures/chatBubble_botRed_tailRight.png"
	end
	
	styleChoices(tone)
end
function setChatNotificationTone(gui, purpose, tone)
	if tone == Enum.DialogTone.Neutral then
		gui.Image.Image = "rbxasset://textures/chatBubble_botBlue_notify_bkg.png"
	elseif tone == Enum.DialogTone.Friendly then
		gui.Image.Image = "rbxasset://textures/chatBubble_botGreen_notify_bkg.png"
	elseif tone == Enum.DialogTone.Enemy then
		gui.Image.Image = "rbxasset://textures/chatBubble_botRed_notify_bkg.png"
	end
	if purpose == Enum.DialogPurpose.Quest then
		gui.Image.Button.Image = "rbxasset://textures/chatBubble_bot_notify_bang.png"
	elseif purpose == Enum.DialogPurpose.Help then
		gui.Image.Button.Image = "rbxasset://textures/chatBubble_bot_notify_question.png"
	elseif purpose == Enum.DialogPurpose.Shop then
		gui.Image.Button.Image = "rbxasset://textures/chatBubble_bot_notify_money.png"
	end
end

function createMessageDialog()
	messageDialog = Instance.new("Frame");
	messageDialog.Name = "DialogScriptMessage"
	messageDialog.Style = Enum.FrameStyle.RobloxRound
	messageDialog.Visible = false

	local text = Instance.new("TextLabel")
	text.Name = "Text"
	text.Position = UDim2.new(0,0,0,-1)
	text.Size = UDim2.new(1,0,1,0)
	text.FontSize = Enum.FontSize.Size14
	text.BackgroundTransparency = 1
	text.TextColor3 = Color3.new(1,1,1)
   text.RobloxLocked = true
	text.Parent = messageDialog
end

function showMessage(msg, size)
	messageDialog.Text.Text = msg
	messageDialog.Size = UDim2.new(0,size,0,40)
	messageDialog.Position = UDim2.new(0.5, -size/2, 0.5, -40)
	messageDialog.Visible = true
	wait(2)
	messageDialog.Visible = false
end

function variableDelay(str)
	local length = math.min(string.len(str), 100)
	wait(0.75 + ((length/75) * 1.5))
end

function resetColor(frame, tone)
	if tone == Enum.DialogTone.Neutral then
		frame.BackgroundColor3 = Color3.new(0/255, 0/255,   179/255) 
		frame.Number.TextColor3 = Color3.new(45/255, 142/255, 245/255) 
	elseif tone == Enum.DialogTone.Friendly then
		frame.BackgroundColor3 = Color3.new(0/255, 77/255,   0/255) 
		frame.Number.TextColor3 = Color3.new(0/255, 190/255, 0/255) 
	elseif tone == Enum.DialogTone.Enemy then
		frame.BackgroundColor3 = Color3.new(140/255, 0/255, 0/255) 
		frame.Number.TextColor3 = Color3.new(255/255,88/255, 79/255) 
	end
end

function highlightColor(frame, tone)
	if tone == Enum.DialogTone.Neutral then
		frame.BackgroundColor3 = Color3.new(2/255, 108/255,   255/255) 
		frame.Number.TextColor3 = Color3.new(1, 1, 1) 
	elseif tone == Enum.DialogTone.Friendly then
		frame.BackgroundColor3 = Color3.new(0/255, 128/255,   0/255) 
		frame.Number.TextColor3 = Color3.new(1, 1, 1) 
	elseif tone == Enum.DialogTone.Enemy then
		frame.BackgroundColor3 = Color3.new(204/255, 0/255, 0/255) 
		frame.Number.TextColor3 = Color3.new(1, 1, 1) 
	end
end

function wanderDialog()
	print("Wander")
	mainFrame.Visible = false
	endDialog()
	showMessage(characterWanderedOffMessage, characterWanderedOffSize)
end

function timeoutDialog()
	print("Timeout")
	mainFrame.Visible = false
	endDialog()
	showMessage(conversationTimedOut, conversationTimedOutSize)
end
function normalEndDialog()
	print("Done")
	endDialog()
end

function endDialog()
   if currentAbortDialogScript then
		currentAbortDialogScript:Remove()
		currentAbortDialogScript = nil
	end

	local dialog = currentConversationDialog 
	currentConversationDialog = nil
	if dialog and dialog.InUse then
		local reenableScript = reenableDialogScript:Clone()
		reenableScript.archivable = false
		reenableScript.Disabled = false
		reenableScript.Parent = dialog
	end

	for dialog, gui in pairs(dialogMap) do
		if dialog and gui then
			gui.Enabled = not dialog.InUse
		end
	end

	currentConversationPartner = nil
end

function sanitizeMessage(msg)
  if string.len(msg) == 0 then
     return "..."
  else
     return msg
  end
end

function selectChoice(choice)
	renewKillswitch(currentConversationDialog)

	--First hide the Gui
	mainFrame.Visible = false
	if choice == lastChoice then
		game.Chat:Chat(game.Players.LocalPlayer.Character, "Goodbye!", getChatColor(currentTone()))
		
		normalEndDialog()
	else 
		local dialogChoice = choiceMap[choice]

		game.Chat:Chat(game.Players.LocalPlayer.Character, sanitizeMessage(dialogChoice.UserDialog), getChatColor(currentTone()))
		wait(1)
		currentConversationDialog:SignalDialogChoiceSelected(player, dialogChoice)
		game.Chat:Chat(currentConversationPartner, sanitizeMessage(dialogChoice.ResponseDialog), getChatColor(currentTone()))
	
		variableDelay(dialogChoice.ResponseDialog)
		presentDialogChoices(currentConversationPartner, dialogChoice:GetChildren())
	end 
end

function newChoice(numberText)
	local frame = Instance.new("TextButton")
	frame.BackgroundColor3 = Color3.new(0/255, 0/255, 179/255)
	frame.AutoButtonColor = false
	frame.BorderSizePixel = 0
	frame.Text = ""
	frame.MouseEnter:connect(function() highlightColor(frame, currentTone()) end)
	frame.MouseLeave:connect(function() resetColor(frame, currentTone()) end)
	frame.MouseButton1Click:connect(function() selectChoice(frame) end)
   frame.RobloxLocked = true

	local number = Instance.new("TextLabel")
	number.Name = "Number"
	number.TextColor3 = Color3.new(127/255, 212/255, 255/255)
	number.Text = numberText
	number.FontSize = Enum.FontSize.Size14
	number.BackgroundTransparency = 1
	number.Position = UDim2.new(0,4,0,2)
	number.Size = UDim2.new(0,20,0,24)
	number.TextXAlignment = Enum.TextXAlignment.Left
	number.TextYAlignment = Enum.TextYAlignment.Top
   number.RobloxLocked = true
	number.Parent = frame

	local prompt = Instance.new("TextLabel")
	prompt.Name = "UserPrompt"
	prompt.BackgroundTransparency = 1
	prompt.TextColor3 = Color3.new(1,1,1)
	prompt.FontSize = Enum.FontSize.Size14
	prompt.Position = UDim2.new(0,28, 0, 2)
	prompt.Size = UDim2.new(1,-32, 1, -4)
	prompt.TextXAlignment = Enum.TextXAlignment.Left
	prompt.TextYAlignment = Enum.TextYAlignment.Top
	prompt.TextWrap = true
   prompt.RobloxLocked = true
	prompt.Parent = frame

	return frame
end
function initialize(parent)
	choices[1] = newChoice("1)")
	choices[2] = newChoice("2)")
	choices[3] = newChoice("3)")
	choices[4] = newChoice("4)")

	lastChoice = newChoice("5)")
	lastChoice.UserPrompt.Text = "Goodbye!"
	lastChoice.Size = UDim2.new(1,0,0,28)

	mainFrame = Instance.new("Frame")
	mainFrame.Name = "UserDialogArea"
	mainFrame.Size = UDim2.new(0, 350, 0, 200)
	mainFrame.Style = Enum.FrameStyle.ChatBlue
	mainFrame.Visible = false
	
	imageLabel = Instance.new("ImageLabel")
	imageLabel.Name = "Tail"
	imageLabel.Size = UDim2.new(0,62,0,53)
	imageLabel.Position = UDim2.new(1,8,0.25)
	imageLabel.Image = "rbxasset://textures/chatBubble_botBlue_tailRight.png"
	imageLabel.BackgroundTransparency = 1
   imageLabel.RobloxLocked = true
	imageLabel.Parent = mainFrame
		
	for n, obj in pairs(choices) do
      obj.RobloxLocked = true
		obj.Parent = mainFrame
	end
   lastChoice.RobloxLocked = true
	lastChoice.Parent = mainFrame

   mainFrame.RobloxLocked = true
	mainFrame.Parent = parent
end

function presentDialogChoices(talkingPart, dialogChoices)
	if not currentConversationDialog then 
		return 
	end

	currentConversationPartner = talkingPart
	sortedDialogChoices = {}
	for n, obj in pairs(dialogChoices) do
		if obj:IsA("DialogChoice") then
			table.insert(sortedDialogChoices, obj)
		end
	end
	table.sort(sortedDialogChoices, function(a,b) return a.Name < b.Name end)

	if #sortedDialogChoices == 0 then
		normalEndDialog()
		return
	end

	local pos = 1
   local yPosition = 0
	choiceMap = {}
	for n, obj in pairs(choices) do
		obj.Visible = false
	end

	for n, obj in pairs(sortedDialogChoices) do
		if pos <= #choices then
			--3 lines is the maximum, set it to that temporarily
			choices[pos].Size = UDim2.new(1, 0, 0, 24*3)
			choices[pos].UserPrompt.Text = obj.UserDialog
			local height = math.ceil(choices[pos].UserPrompt.TextBounds.Y/24)*24

			choices[pos].Position = UDim2.new(0, 0, 0, yPosition)
			choices[pos].Size = UDim2.new(1, 0, 0, height)
			choices[pos].Visible = true
		
			choiceMap[choices[pos]] = obj

			yPosition = yPosition + height
			pos = pos + 1
		end
	end

	lastChoice.Position = UDim2.new(0,0,0,yPosition)	
	lastChoice.Number.Text = pos .. ")"

	mainFrame.Size = UDim2.new(0, 350, 0, yPosition+24+32)
	mainFrame.Position = UDim2.new(0,20,0.0, -mainFrame.Size.Y.Offset-20)
	styleMainFrame(currentTone())
	mainFrame.Visible = true
end

function doDialog(dialog)
	while not Instance.Lock(dialog, player) do
		wait()
	end

	if dialog.InUse then
		Instance.Unlock(dialog)
		return 			
	else
		dialog.InUse = true
		Instance.Unlock(dialog)
	end

	currentConversationDialog = dialog
	game.Chat:Chat(dialog.Parent, dialog.InitialPrompt, getChatColor(dialog.Tone))
	variableDelay(dialog.InitialPrompt)

	presentDialogChoices(dialog.Parent, dialog:GetChildren())
end

function renewKillswitch(dialog)
	if currentAbortDialogScript then
		currentAbortDialogScript:Remove()
		currentAbortDialogScript = nil
	end

	currentAbortDialogScript = timeoutScript:Clone()
	currentAbortDialogScript.archivable = false
	currentAbortDialogScript.Disabled = false
	currentAbortDialogScript.Parent = dialog
end

function checkForLeaveArea()
	while currentConversationDialog do
		if currentConversationDialog.Parent and (player:DistanceFromCharacter(currentConversationDialog.Parent.Position) >= currentConversationDialog.ConversationDistance) then
			wanderDialog()
		end
		wait(1)		
	end
end

function startDialog(dialog)
	if dialog.Parent and dialog.Parent:IsA("BasePart") then
		if player:DistanceFromCharacter(dialog.Parent.Position) >= dialog.ConversationDistance then
			showMessage(tooFarAwayMessage, tooFarAwaySize)
			return
		end	
		
		for dialog, gui in pairs(dialogMap) do
			if dialog and gui then
				gui.Enabled = false
			end
		end

		renewKillswitch(dialog)

		delay(1, checkForLeaveArea)
		doDialog(dialog)
	end
end

function removeDialog(dialog)
   if dialogMap[dialog] then
      dialogMap[dialog]:Remove()
      dialogMap[dialog] = nil
   end
	if dialogConnections[dialog] then
		dialogConnections[dialog]:disconnect()
		dialogConnections[dialog] = nil
	end
end	

function addDialog(dialog)
	if dialog.Parent and dialog.Parent:IsA("BasePart") then
		local chatGui = chatNotificationGui:clone()
		chatGui.Enabled = not dialog.InUse		
		chatGui.Adornee = dialog.Parent
      chatGui.RobloxLocked = true
		chatGui.Parent = game.CoreGui
		chatGui.Image.Button.MouseButton1Click:connect(function() startDialog(dialog) end)
		setChatNotificationTone(chatGui, dialog.Purpose, dialog.Tone)
		
      dialogMap[dialog] = chatGui

      dialogConnections[dialog] = dialog.Changed:connect(function(prop)
          if prop == "Parent" and dialog.Parent then 
		        --This handles the reparenting case, seperate from removal case
              removeDialog(dialog) 
				  addDialog(dialog) 
          elseif prop == "InUse" then
              chatGui.Enabled = not currentConversationDialog and not dialog.InUse
				  if dialog == currentConversationDialog then
						timeoutDialog()
				  end
			 elseif prop == "Tone" or prop == "Purpose" then
				  setChatNotificationTone(chatGui, dialog.Purpose, dialog.Tone)
          end 
		end)
	end
end

function fetchScripts()
	--[[local model = game:GetService("InsertService"):LoadAsset(39226062)
    if type(model) == "string" then -- load failed, lets try again
		wait(0.1)
		model = game:GetService("InsertService"):LoadAsset(39226062)
	end
	if type(model) == "string" then -- not going to work, lets bail
		return
	end
	
	waitForChild(model,"TimeoutScript")
	timeoutScript = model.TimeoutScript
	waitForChild(model,"ReenableDialogScript")
	reenableDialogScript = model.ReenableDialogScript]]
	--if not game.Lighting:FindFirstChild("CoreDialogScripts") then
		--game.Workspace:InsertContent("rbxasset://scripts\\cores\\MainBotSupport.rbxm")
	--end
	waitForChild(game.Lighting,"CoreDialogScripts")
	local model = game.Lighting.CoreDialogScripts
	waitForChild(model,"TimeoutScript")
	timeoutScript = model.TimeoutScript:Clone()
	waitForChild(model,"ReenableDialogScript")
	reenableDialogScript = model.ReenableDialogScript:Clone()
end

function onLoad()
  waitForProperty(game.Players, "LocalPlayer")
  player = game.Players.LocalPlayer
  waitForProperty(player, "Character")

  --print("Fetching Scripts")
  fetchScripts()

  --print("Creating Guis")
  createChatNotificationGui()

  --print("Creating MessageDialog")
  createMessageDialog()
  messageDialog.RobloxLocked = true
  messageDialog.Parent = gui
  
  --print("Waiting for BottomLeftControl")
  waitForChild(gui, "BottomLeftControl")
  
  --print("Initializing Frame")
  local frame = Instance.new("Frame")
  frame.Name = "DialogFrame"
  frame.Position = UDim2.new(0,0,0,0)
  frame.Size = UDim2.new(0,0,0,0)
  frame.BackgroundTransparency = 1
  frame.RobloxLocked = true
  frame.Parent = gui.BottomLeftControl
  initialize(frame)

  --print("Adding Dialogs")
  game.CollectionService.ItemAdded:connect(function(obj) if obj:IsA("Dialog") then addDialog(obj) end end)
  game.CollectionService.ItemRemoved:connect(function(obj) if obj:IsA("Dialog") then removeDialog(obj) end end)
  for i, obj in pairs(game.CollectionService:GetCollection("Dialog")) do
    if obj:IsA("Dialog") then
       addDialog(obj)
    end
  end
end

onLoad()

end)

print("Starting playerlist...")
-- RBXGUI START --
local RbxGuiLib = {}

local function ScopedConnect(parentInstance, instance, event, signalFunc, syncFunc, removeFunc)
	local eventConnection = nil

	--Connection on parentInstance is scoped by parentInstance (when destroyed, it goes away)
	local tryConnect = function()
		if game:IsAncestorOf(parentInstance) then
			--Entering the world, make sure we are connected/synced
			if not eventConnection then
				eventConnection = instance[event]:connect(signalFunc)
				if syncFunc then syncFunc() end
			end
		else
			--Probably leaving the world, so disconnect for now
			if eventConnection then
				eventConnection:disconnect()
				if removeFunc then removeFunc() end
			end
		end
	end

	--Hook it up to ancestryChanged signal
	local connection = parentInstance.AncestryChanged:connect(tryConnect)
	
	--Now connect us if we're already in the world
	tryConnect()
	
	return connection
end

local function CreateButtons(frame, buttons, yPos, ySize)
	local buttonNum = 1
	local buttonObjs = {}
	for i, obj in ipairs(buttons) do 
		local button = Instance.new("TextButton")
		button.Name = "Button" .. buttonNum
		button.Font = Enum.Font.Arial
		button.FontSize = Enum.FontSize.Size18
		button.AutoButtonColor = true
		button.Style = Enum.ButtonStyle.RobloxButtonDefault 
		button.Text = obj.Text
		button.TextColor3 = Color3.new(1,1,1)
		button.MouseButton1Click:connect(obj.Function)
		button.Parent = frame
		buttonObjs[buttonNum] = button

		buttonNum = buttonNum + 1
	end
	local numButtons = buttonNum-1

	if numButtons == 1 then
		frame.Button1.Position = UDim2.new(0.35, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.4,0,ySize.Scale, ySize.Offset)
	elseif numButtons == 2 then
		frame.Button1.Position = UDim2.new(0.1, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.8/3,0, ySize.Scale, ySize.Offset)

		frame.Button2.Position = UDim2.new(0.55, 0, yPos.Scale, yPos.Offset)
		frame.Button2.Size = UDim2.new(.35,0, ySize.Scale, ySize.Offset)
	elseif numButtons >= 3 then
		local spacing = .1 / numButtons
		local buttonSize = .9 / numButtons

		buttonNum = 1
		while buttonNum <= numButtons do
			buttonObjs[buttonNum].Position = UDim2.new(spacing*buttonNum + (buttonNum-1) * buttonSize, 0, yPos.Scale, yPos.Offset)
			buttonObjs[buttonNum].Size = UDim2.new(buttonSize, 0, ySize.Scale, ySize.Offset)
			buttonNum = buttonNum + 1
		end
	end
end

local function setSliderPos(newAbsPosX,slider,sliderPosition,bar,steps)

	local newStep = steps - 1 --otherwise we really get one more step than we want
	
	local relativePosX = math.min(1, math.max(0, (newAbsPosX - bar.AbsolutePosition.X) / bar.AbsoluteSize.X ) )
	local wholeNum, remainder = math.modf(relativePosX * newStep)
	if remainder > 0.5 then
		wholeNum = wholeNum + 1
	end
	relativePosX = wholeNum/newStep

	local result = math.ceil(relativePosX * newStep)
	if sliderPosition.Value ~= (result + 1) then --onky update if we moved a step
		sliderPosition.Value = result + 1
		
		if relativePosX == 1 then
			slider.Position = UDim2.new(1,-slider.AbsoluteSize.X,slider.Position.Y.Scale,slider.Position.Y.Offset)
		else
			slider.Position = UDim2.new(relativePosX,0,slider.Position.Y.Scale,slider.Position.Y.Offset)
		end
	end
	
end

local function cancelSlide(areaSoak)
	areaSoak.Visible = false
	if areaSoakMouseMoveCon then areaSoakMouseMoveCon:disconnect() end
end

RbxGuiLib.CreateStyledMessageDialog = function(title, message, style, buttons)
	local frame = Instance.new("Frame")
	frame.Size = UDim2.new(0.5, 0, 0, 165)
	frame.Position = UDim2.new(0.25, 0, 0.5, -72.5)
	frame.Name = "MessageDialog"
	frame.Active = true
	frame.Style = Enum.FrameStyle.RobloxRound	
	
	local styleImage = Instance.new("ImageLabel")
	styleImage.Name = "StyleImage"
	styleImage.BackgroundTransparency = 1
	styleImage.Position = UDim2.new(0,5,0,15)
	if style == "error" or style == "Error" then
		styleImage.Size = UDim2.new(0, 71, 0, 71)
		styleImage.Image = "rbxasset://textures/ui/Error.png"
	elseif style == "notify" or style == "Notify" then
		styleImage.Size = UDim2.new(0, 71, 0, 71)
		styleImage.Image = "rbxasset://textures/ui/Notify.png"
	elseif style == "confirm" or style == "Confirm" then
		styleImage.Size = UDim2.new(0, 74, 0, 76)
		styleImage.Image = "rbxasset://textures/ui/Confirm.png"
	else
		return RbxGuiLib.CreateMessageDialog(title,message,buttons)
	end
	styleImage.Parent = frame
	
	local titleLabel = Instance.new("TextLabel")
	titleLabel.Name = "Title"
	titleLabel.Text = title
	titleLabel.BackgroundTransparency = 1
	titleLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	titleLabel.Position = UDim2.new(0, 80, 0, 0)
	titleLabel.Size = UDim2.new(1, -80, 0, 40)
	titleLabel.Font = Enum.Font.ArialBold
	titleLabel.FontSize = Enum.FontSize.Size36
	titleLabel.TextXAlignment = Enum.TextXAlignment.Center
	titleLabel.TextYAlignment = Enum.TextYAlignment.Center
	titleLabel.Parent = frame

	local messageLabel = Instance.new("TextLabel")
	messageLabel.Name = "Message"
	messageLabel.Text = message
	messageLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	messageLabel.Position = UDim2.new(0.025, 80, 0, 45)
	messageLabel.Size = UDim2.new(0.95, -80, 0, 55)
	messageLabel.BackgroundTransparency = 1
	messageLabel.Font = Enum.Font.Arial
	messageLabel.FontSize = Enum.FontSize.Size18
	messageLabel.TextWrap = true
	messageLabel.TextXAlignment = Enum.TextXAlignment.Left
	messageLabel.TextYAlignment = Enum.TextYAlignment.Top
	messageLabel.Parent = frame

	CreateButtons(frame, buttons, UDim.new(0, 105), UDim.new(0, 40) )

	return frame
end

RbxGuiLib.CreateMessageDialog = function(title, message, buttons)
	local frame = Instance.new("Frame")
	frame.Size = UDim2.new(0.5, 0, 0.5, 0)
	frame.Position = UDim2.new(0.25, 0, 0.25, 0)
	frame.Name = "MessageDialog"
	frame.Active = true
	frame.Style = Enum.FrameStyle.RobloxRound

	local titleLabel = Instance.new("TextLabel")
	titleLabel.Name = "Title"
	titleLabel.Text = title
	titleLabel.BackgroundTransparency = 1
	titleLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	titleLabel.Position = UDim2.new(0, 0, 0, 0)
	titleLabel.Size = UDim2.new(1, 0, 0.15, 0)
	titleLabel.Font = Enum.Font.ArialBold
	titleLabel.FontSize = Enum.FontSize.Size36
	titleLabel.TextXAlignment = Enum.TextXAlignment.Center
	titleLabel.TextYAlignment = Enum.TextYAlignment.Center
	titleLabel.Parent = frame

	local messageLabel = Instance.new("TextLabel")
	messageLabel.Name = "Message"
	messageLabel.Text = message
	messageLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	messageLabel.Position = UDim2.new(0.025, 0, 0.175, 0)
	messageLabel.Size = UDim2.new(0.95, 0, .55, 0)
	messageLabel.BackgroundTransparency = 1
	messageLabel.Font = Enum.Font.Arial
	messageLabel.FontSize = Enum.FontSize.Size18
	messageLabel.TextWrap = true
	messageLabel.TextXAlignment = Enum.TextXAlignment.Left
	messageLabel.TextYAlignment = Enum.TextYAlignment.Top
	messageLabel.Parent = frame

	CreateButtons(frame, buttons, UDim.new(0.8,0), UDim.new(0.15, 0))

	return frame
end

RbxGuiLib.CreateDropDownMenu = function(items, onSelect, forRoblox)
	local width = UDim.new(0, 100)
	local height = UDim.new(0, 32)

	local xPos = 0.055
	local frame = Instance.new("Frame")
	frame.Name = "DropDownMenu"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(width, height)

	local dropDownMenu = Instance.new("TextButton")
	dropDownMenu.Name = "DropDownMenuButton"
	dropDownMenu.TextWrap = true
	dropDownMenu.TextColor3 = Color3.new(1,1,1)
	dropDownMenu.Text = "Choose One"
	dropDownMenu.Font = Enum.Font.ArialBold
	dropDownMenu.FontSize = Enum.FontSize.Size18
	dropDownMenu.TextXAlignment = Enum.TextXAlignment.Left
	dropDownMenu.TextYAlignment = Enum.TextYAlignment.Center
	dropDownMenu.BackgroundTransparency = 1
	dropDownMenu.AutoButtonColor = true
	dropDownMenu.Style = Enum.ButtonStyle.RobloxButton
	dropDownMenu.Size = UDim2.new(1,0,1,0)
	dropDownMenu.Parent = frame
	dropDownMenu.ZIndex = 2

	local dropDownIcon = Instance.new("ImageLabel")
	dropDownIcon.Name = "Icon"
	dropDownIcon.Active = false
	dropDownIcon.Image = "rbxasset://textures/ui/DropDown.png"
	dropDownIcon.BackgroundTransparency = 1
	dropDownIcon.Size = UDim2.new(0,11,0,6)
	dropDownIcon.Position = UDim2.new(1,-11,0.5, -2)
	dropDownIcon.Parent = dropDownMenu
	dropDownIcon.ZIndex = 2
	
	local itemCount = #items
	local dropDownItemCount = #items
	local useScrollButtons = false
	if dropDownItemCount > 6 then
		useScrollButtons = true
		dropDownItemCount = 6
	end
	
	local droppedDownMenu = Instance.new("TextButton")
	droppedDownMenu.Name = "List"
	droppedDownMenu.Text = ""
	droppedDownMenu.BackgroundTransparency = 1
	--droppedDownMenu.AutoButtonColor = true
	droppedDownMenu.Style = Enum.ButtonStyle.RobloxButton
	droppedDownMenu.Visible = false
	droppedDownMenu.Active = true	--Blocks clicks
	droppedDownMenu.Position = UDim2.new(0,0,0,0)
	droppedDownMenu.Size = UDim2.new(1,0, (1 + dropDownItemCount)*.8, 0)
	droppedDownMenu.Parent = frame
	droppedDownMenu.ZIndex = 2

	local choiceButton = Instance.new("TextButton")
	choiceButton.Name = "ChoiceButton"
	choiceButton.BackgroundTransparency = 1
	choiceButton.BorderSizePixel = 0
	choiceButton.Text = "ReplaceMe"
	choiceButton.TextColor3 = Color3.new(1,1,1)
	choiceButton.TextXAlignment = Enum.TextXAlignment.Left
	choiceButton.TextYAlignment = Enum.TextYAlignment.Center
	choiceButton.BackgroundColor3 = Color3.new(1, 1, 1)
	choiceButton.Font = Enum.Font.Arial
	choiceButton.FontSize = Enum.FontSize.Size18
	if useScrollButtons then
		choiceButton.Size = UDim2.new(1,-13, .8/((dropDownItemCount + 1)*.8),0) 
	else
		choiceButton.Size = UDim2.new(1, 0, .8/((dropDownItemCount + 1)*.8),0) 
	end
	choiceButton.TextWrap = true
	choiceButton.ZIndex = 2

	local dropDownSelected = false

	local scrollUpButton 
	local scrollDownButton
	local scrollMouseCount = 0

	local setZIndex = function(baseZIndex)
		droppedDownMenu.ZIndex = baseZIndex +1
		if scrollUpButton then
			scrollUpButton.ZIndex = baseZIndex + 3
		end
		if scrollDownButton then
			scrollDownButton.ZIndex = baseZIndex + 3
		end
		
		local children = droppedDownMenu:GetChildren()
		if children then
			for i, child in ipairs(children) do
				if child.Name == "ChoiceButton" then
					child.ZIndex = baseZIndex + 2
				elseif child.Name == "ClickCaptureButton" then
					child.ZIndex = baseZIndex
				end
			end
		end
	end

	local scrollBarPosition = 1
	local updateScroll = function()
		if scrollUpButton then
			scrollUpButton.Active = scrollBarPosition > 1 
		end
		if scrollDownButton then
			scrollDownButton.Active = scrollBarPosition + dropDownItemCount <= itemCount 
		end

		local children = droppedDownMenu:GetChildren()
		if not children then return end

		local childNum = 1			
		for i, obj in ipairs(children) do
			if obj.Name == "ChoiceButton" then
				if childNum < scrollBarPosition or childNum >= scrollBarPosition + dropDownItemCount then
					obj.Visible = false
				else
					obj.Position = UDim2.new(0,0,((childNum-scrollBarPosition+1)*.8)/((dropDownItemCount+1)*.8),0)
					obj.Visible = true
				end
				obj.TextColor3 = Color3.new(1,1,1)
				obj.BackgroundTransparency = 1

				childNum = childNum + 1
			end
		end
	end
	local toggleVisibility = function()
		dropDownSelected = not dropDownSelected

		dropDownMenu.Visible = not dropDownSelected
		droppedDownMenu.Visible = dropDownSelected
		if dropDownSelected then
			setZIndex(4)
		else
			setZIndex(2)
		end
		if useScrollButtons then
			updateScroll()
		end
	end
	droppedDownMenu.MouseButton1Click:connect(toggleVisibility)

	local updateSelection = function(text)
		local foundItem = false
		local children = droppedDownMenu:GetChildren()
		local childNum = 1
		if children then
			for i, obj in ipairs(children) do
				if obj.Name == "ChoiceButton" then
					if obj.Text == text then
						obj.Font = Enum.Font.ArialBold
						foundItem = true			
						scrollBarPosition = childNum
					else
						obj.Font = Enum.Font.Arial
					end
					childNum = childNum + 1
				end
			end
		end
		if not text then
			dropDownMenu.Text = "Choose One"
			scrollBarPosition = 1
		else
			if not foundItem then
				error("Invalid Selection Update -- " .. text)
			end

			if scrollBarPosition + dropDownItemCount > itemCount + 1 then
				scrollBarPosition = itemCount - dropDownItemCount + 1
			end

			dropDownMenu.Text = text
		end
	end
	
	local function scrollDown()
		if scrollBarPosition + dropDownItemCount <= itemCount then
			scrollBarPosition = scrollBarPosition + 1
			updateScroll()
			return true
		end
		return false
	end
	local function scrollUp()
		if scrollBarPosition > 1 then
			scrollBarPosition = scrollBarPosition - 1
			updateScroll()
			return true
		end
		return false
	end
	
	if useScrollButtons then
		--Make some scroll buttons
		scrollUpButton = Instance.new("ImageButton")
		scrollUpButton.Name = "ScrollUpButton"
		scrollUpButton.BackgroundTransparency = 1
		scrollUpButton.Image = "rbxasset://textures/ui/scrollbuttonUp.png"
		scrollUpButton.Size = UDim2.new(0,17,0,17) 
		scrollUpButton.Position = UDim2.new(1,-11,(1*.8)/((dropDownItemCount+1)*.8),0)
		scrollUpButton.MouseButton1Click:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollUpButton.MouseLeave:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollUpButton.MouseButton1Down:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
	
				scrollUp()
				local val = scrollMouseCount
				wait(0.5)
				while val == scrollMouseCount do
					if scrollUp() == false then
						break
					end
					wait(0.1)
				end				
			end)

		scrollUpButton.Parent = droppedDownMenu

		scrollDownButton = Instance.new("ImageButton")
		scrollDownButton.Name = "ScrollDownButton"
		scrollDownButton.BackgroundTransparency = 1
		scrollDownButton.Image = "rbxasset://textures/ui/scrollbuttonDown.png"
		scrollDownButton.Size = UDim2.new(0,17,0,17) 
		scrollDownButton.Position = UDim2.new(1,-11,1,-11)
		scrollDownButton.Parent = droppedDownMenu
		scrollDownButton.MouseButton1Click:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollDownButton.MouseLeave:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollDownButton.MouseButton1Down:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1

				scrollDown()
				local val = scrollMouseCount
				wait(0.5)
				while val == scrollMouseCount do
					if scrollDown() == false then
						break
					end
					wait(0.1)
				end				
			end)	

		local scrollbar = Instance.new("ImageLabel")
		scrollbar.Name = "ScrollBar"
		scrollbar.Image = "rbxasset://textures/ui/scrollbar.png"
		scrollbar.BackgroundTransparency = 1
		scrollbar.Size = UDim2.new(0, 18, (dropDownItemCount*.8)/((dropDownItemCount+1)*.8), -(17) - 11 - 4)
		scrollbar.Position = UDim2.new(1,-11,(1*.8)/((dropDownItemCount+1)*.8),17+2)
		scrollbar.Parent = droppedDownMenu
	end

	for i,item in ipairs(items) do
		-- needed to maintain local scope for items in event listeners below
		local button = choiceButton:clone()
		if forRoblox then
			button.RobloxLocked = true
		end		
		button.Text = item
		button.Parent = droppedDownMenu
		button.MouseButton1Click:connect(function()
			--Remove Highlight
			button.TextColor3 = Color3.new(1,1,1)
			button.BackgroundTransparency = 1

			updateSelection(item)
			onSelect(item)

			toggleVisibility()
		end)
		button.MouseEnter:connect(function()
			--Add Highlight	
			button.TextColor3 = Color3.new(0,0,0)
			button.BackgroundTransparency = 0
		end)

		button.MouseLeave:connect(function()
			--Remove Highlight
			button.TextColor3 = Color3.new(1,1,1)
			button.BackgroundTransparency = 1
		end)
	end

	--This does the initial layout of the buttons	
	updateScroll()

	local bigFakeButton = Instance.new("TextButton")
	bigFakeButton.BackgroundTransparency = 1
	bigFakeButton.Name = "ClickCaptureButton"
	bigFakeButton.Size = UDim2.new(0, 4000, 0, 3000)
	bigFakeButton.Position = UDim2.new(0, -2000, 0, -1500)
	bigFakeButton.ZIndex = 1
	bigFakeButton.Text = ""
	bigFakeButton.Parent = droppedDownMenu
	bigFakeButton.MouseButton1Click:connect(toggleVisibility)

	dropDownMenu.MouseButton1Click:connect(toggleVisibility)
	return frame, updateSelection
end

RbxGuiLib.CreatePropertyDropDownMenu = function(instance, property, enum)

	local items = enum:GetEnumItems()
	local names = {}
	local nameToItem = {}
	for i,obj in ipairs(items) do
		names[i] = obj.Name
		nameToItem[obj.Name] = obj
	end

	local frame
	local updateSelection
	frame, updateSelection = RbxGuiLib.CreateDropDownMenu(names, function(text) instance[property] = nameToItem[text] end)

	ScopedConnect(frame, instance, "Changed", 
		function(prop)
			if prop == property then
				updateSelection(instance[property].Name)
			end
		end,
		function()
			updateSelection(instance[property].Name)
		end)

	return frame
end

RbxGuiLib.GetFontHeight = function(font, fontSize)
	if font == nil or fontSize == nil then
		error("Font and FontSize must be non-nil")
	end

	if font == Enum.Font.Legacy then
		if fontSize == Enum.FontSize.Size8 then
			return 12
		elseif fontSize == Enum.FontSize.Size9 then
			return 14
		elseif fontSize == Enum.FontSize.Size10 then
			return 15
		elseif fontSize == Enum.FontSize.Size11 then
			return 17
		elseif fontSize == Enum.FontSize.Size12 then
			return 18
		elseif fontSize == Enum.FontSize.Size14 then
			return 21
		elseif fontSize == Enum.FontSize.Size18 then
			return 27
		elseif fontSize == Enum.FontSize.Size24 then
			return 36
		elseif fontSize == Enum.FontSize.Size36 then
			return 54
		elseif fontSize == Enum.FontSize.Size48 then
			return 72
		else
			error("Unknown FontSize")
		end
	elseif font == Enum.Font.Arial or font == Enum.Font.ArialBold then
		if fontSize == Enum.FontSize.Size8 then
			return 8
		elseif fontSize == Enum.FontSize.Size9 then
			return 9
		elseif fontSize == Enum.FontSize.Size10 then
			return 10
		elseif fontSize == Enum.FontSize.Size11 then
			return 11
		elseif fontSize == Enum.FontSize.Size12 then
			return 12
		elseif fontSize == Enum.FontSize.Size14 then
			return 14
		elseif fontSize == Enum.FontSize.Size18 then
			return 18
		elseif fontSize == Enum.FontSize.Size24 then
			return 24
		elseif fontSize == Enum.FontSize.Size36 then
			return 36
		elseif fontSize == Enum.FontSize.Size48 then
			return 48
		else
			error("Unknown FontSize")
		end
	else
		error("Unknown Font " .. font)
	end
end

local function layoutGuiObjectsHelper(frame, guiObjects, settingsTable)
	local totalPixels = frame.AbsoluteSize.Y
	local pixelsRemaining = frame.AbsoluteSize.Y
	for i, child in ipairs(guiObjects) do
		if child:IsA("TextLabel") or child:IsA("TextButton") then
			local isLabel = child:IsA("TextLabel")
			if isLabel then
				pixelsRemaining = pixelsRemaining - settingsTable["TextLabelPositionPadY"]
			else
				pixelsRemaining = pixelsRemaining - settingsTable["TextButtonPositionPadY"]
			end
			child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
			child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, pixelsRemaining)

			if child.TextFits and child.TextBounds.Y < pixelsRemaining then
				child.Visible = true
				if isLabel then
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.TextBounds.Y + settingsTable["TextLabelSizePadY"])
				else 
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.TextBounds.Y + settingsTable["TextButtonSizePadY"])
				end

				while not child.TextFits do
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.AbsoluteSize.Y + 1)
				end
				pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y		

				if isLabel then
					pixelsRemaining = pixelsRemaining - settingsTable["TextLabelPositionPadY"]
				else
					pixelsRemaining = pixelsRemaining - settingsTable["TextButtonPositionPadY"]
				end
			else
				child.Visible = false
				pixelsRemaining = -1
			end			

		else
			--GuiObject
			child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
			pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y
			child.Visible = (pixelsRemaining >= 0)
		end
	end
end

RbxGuiLib.LayoutGuiObjects = function(frame, guiObjects, settingsTable)
	if not frame:IsA("GuiObject") then
		error("Frame must be a GuiObject")
	end
	for i, child in ipairs(guiObjects) do
		if not child:IsA("GuiObject") then
			error("All elements that are layed out must be of type GuiObject")
		end
	end

	if not settingsTable then
		settingsTable = {}
	end

	if not settingsTable["TextLabelSizePadY"] then
		settingsTable["TextLabelSizePadY"] = 0
	end
	if not settingsTable["TextLabelPositionPadY"] then
		settingsTable["TextLabelPositionPadY"] = 0
	end
	if not settingsTable["TextButtonSizePadY"] then
		settingsTable["TextButtonSizePadY"] = 12
	end
	if not settingsTable["TextButtonPositionPadY"] then
		settingsTable["TextButtonPositionPadY"] = 2
	end

	--Wrapper frame takes care of styled objects
	local wrapperFrame = Instance.new("Frame")
	wrapperFrame.Name = "WrapperFrame"
	wrapperFrame.BackgroundTransparency = 1
	wrapperFrame.Size = UDim2.new(1,0,1,0)
	wrapperFrame.Parent = frame

	for i, child in ipairs(guiObjects) do
		child.Parent = wrapperFrame
	end

	local recalculate = function()
		wait()
		layoutGuiObjectsHelper(wrapperFrame, guiObjects, settingsTable)
	end
	
	frame.Changed:connect(
		function(prop)
			if prop == "AbsoluteSize" then
				--Wait a heartbeat for it to sync in
				recalculate()
			end
		end)
	frame.AncestryChanged:connect(recalculate)

	layoutGuiObjectsHelper(wrapperFrame, guiObjects, settingsTable)
end


RbxGuiLib.CreateSlider = function(steps,width,position)
	local sliderGui = Instance.new("Frame")
	sliderGui.Size = UDim2.new(1,0,1,0)
	sliderGui.BackgroundTransparency = 1
	sliderGui.Name = "SliderGui"
	
	local areaSoak = Instance.new("TextButton")
	areaSoak.Name = "AreaSoak"
	areaSoak.Text = ""
	areaSoak.BackgroundTransparency = 1
	areaSoak.Active = false
	areaSoak.Size = UDim2.new(1,0,1,0)
	areaSoak.Visible = false
	areaSoak.ZIndex = 4
	areaSoak.Parent = sliderGui
	
	local sliderPosition = Instance.new("IntValue")
	sliderPosition.Name = "SliderPosition"
	sliderPosition.Value = 0
	sliderPosition.Parent = sliderGui
	
	local id = math.random(1,100)
	
	local bar = Instance.new("Frame")
	bar.Name = "Bar"
	bar.BackgroundColor3 = Color3.new(0,0,0)
	if type(width) == "number" then
		bar.Size = UDim2.new(0,width,0,5)
	else
		bar.Size = UDim2.new(0,200,0,5)
	end
	bar.BorderColor3 = Color3.new(95/255,95/255,95/255)
	bar.ZIndex = 2
	bar.Parent = sliderGui
	
	if position["X"] and position["X"]["Scale"] and position["X"]["Offset"] and position["Y"] and position["Y"]["Scale"] and position["Y"]["Offset"] then
		bar.Position = position
	end
	
	local slider = Instance.new("ImageButton")
	slider.Name = "Slider"
	slider.BackgroundTransparency = 1
	slider.Image = "rbxasset://textures/ui/Slider.png"
	slider.Position = UDim2.new(0,0,0.5,-10)
	slider.Size = UDim2.new(0,20,0,20)
	slider.ZIndex = 3
	slider.Parent = bar
	
	local areaSoakMouseMoveCon = nil
	
	areaSoak.MouseLeave:connect(function()
		if areaSoak.Visible then
			cancelSlide(areaSoak)
		end
	end)
	areaSoak.MouseButton1Up:connect(function()
		if areaSoak.Visible then
			cancelSlide(areaSoak)
		end
	end)
	
	slider.MouseButton1Down:connect(function()
		areaSoak.Visible = true
		if areaSoakMouseMoveCon then areaSoakMouseMoveCon:disconnect() end
		areaSoakMouseMoveCon = areaSoak.MouseMoved:connect(function(x,y)
			setSliderPos(x,slider,sliderPosition,bar,steps)
		end)
	end)
	
	slider.MouseButton1Up:connect(function() cancelSlide(areaSoak) end)
	
	sliderPosition.Changed:connect(function(prop)
		sliderPosition.Value = math.min(steps, math.max(1,sliderPosition.Value))
		local relativePosX = (sliderPosition.Value) / steps
		if relativePosX >= 1 then
			slider.Position = UDim2.new(relativePosX,-20,slider.Position.Y.Scale,slider.Position.Y.Offset)
		else
			slider.Position = UDim2.new(relativePosX,0,slider.Position.Y.Scale,slider.Position.Y.Offset)
		end
	end)
	
	return sliderGui, sliderPosition

end


RbxGuiLib.CreateScrollingFrame = function(orderList,scrollStyle)
	local frame = Instance.new("Frame")
	frame.Name = "ScrollingFrame"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(1,0,1,0)
	
	local scrollUpButton = Instance.new("ImageButton")
	scrollUpButton.Name = "ScrollUpButton"
	scrollUpButton.BackgroundTransparency = 1
	scrollUpButton.Image = "rbxasset://textures/ui/scrollbuttonUp.png"
	scrollUpButton.Size = UDim2.new(0,17,0,17) 

	
	local scrollDownButton = Instance.new("ImageButton")
	scrollDownButton.Name = "ScrollDownButton"
	scrollDownButton.BackgroundTransparency = 1
	scrollDownButton.Image = "rbxasset://textures/ui/scrollbuttonDown.png"
	scrollDownButton.Size = UDim2.new(0,17,0,17) 

	local style = "simple"
	if scrollStyle and tostring(scrollStyle) then
		style = scrollStyle
	end
	
	local scrollPosition = 1
	local rowSize = 1
	
	local layoutGridScrollBar = function()
		local guiObjects = {}
		if orderList then
			for i, child in ipairs(orderList) do
				if child.Parent == frame then
					table.insert(guiObjects, child)
				end
			end
		else
			local children = frame:GetChildren()
			if children then
				for i, child in ipairs(children) do 
					if child:IsA("GuiObject") then
						table.insert(guiObjects, child)
					end
				end
			end
		end
		if #guiObjects == 0 then
			scrollUpButton.Active = false
			scrollDownButton.Active = false
			scrollPosition = 1
			return
		end

		if scrollPosition > #guiObjects then
			scrollPosition = #guiObjects
		end
		
		local totalPixelsY = frame.AbsoluteSize.Y
		local pixelsRemainingY = frame.AbsoluteSize.Y
		
		local totalPixelsX  = frame.AbsoluteSize.X
		
		local xCounter = 0
		local rowSizeCounter = 0
		local setRowSize = true

		local pixelsBelowScrollbar = 0
		local pos = #guiObjects
		while pixelsBelowScrollbar < totalPixelsY and pos >= 1 do
			if pos >= scrollPosition then
				pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
			else
				xCounter = xCounter + guiObjects[pos].AbsoluteSize.X
				rowSizeCounter = rowSizeCounter + 1
				if xCounter >= totalPixelsX then
					if setRowSize then
						rowSize = rowSizeCounter - 1
						setRowSize = false
					end
					
					rowSizeCounter = 0
					xCounter = 0
					if pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y <= totalPixelsY then
						--It fits, so back up our scroll position
						pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
						if scrollPosition <= rowSize then
							scrollPosition = rowSize 
							break
						else
							--print("Backing up ScrollPosition from -- " ..scrollPosition)
							scrollPosition = scrollPosition - rowSize 
						end
					else
						break
					end
				end
			end
			pos = pos - 1
		end

		xCounter = 0
		--print("ScrollPosition = " .. scrollPosition)
		pos = scrollPosition
		rowSizeCounter = 0
		setRowSize = true
		local lastChildSize = 0
		
		local xOffset,yOffset = 0
		if guiObjects[1] then
			yOffset = math.ceil(math.floor(math.fmod(totalPixelsY,guiObjects[1].AbsoluteSize.X))/2)
			xOffset = math.ceil(math.floor(math.fmod(totalPixelsX,guiObjects[1].AbsoluteSize.Y))/2)
		end
		
		for i, child in ipairs(guiObjects) do
			if i < scrollPosition then
				--print("Hiding " .. child.Name)
				child.Visible = false
			else
				if pixelsRemainingY < 0 then
					--print("Out of Space " .. child.Name)
					child.Visible = false
				else
					--print("Laying out " .. child.Name)
					--GuiObject
					if setRowSize then rowSizeCounter = rowSizeCounter + 1 end
					if xCounter + child.AbsoluteSize.X >= totalPixelsX then
						if setRowSize then
							rowSize = rowSizeCounter - 1
							setRowSize = false
						end
						xCounter = 0
						pixelsRemainingY = pixelsRemainingY - child.AbsoluteSize.Y
					end
					child.Position = UDim2.new(child.Position.X.Scale,xCounter + xOffset, 0, totalPixelsY - pixelsRemainingY + yOffset)
					xCounter = xCounter + child.AbsoluteSize.X
					child.Visible = ((pixelsRemainingY - child.AbsoluteSize.Y) >= 0)
					lastChildSize = child.AbsoluteSize				
				end
			end
		end

		scrollUpButton.Active = (scrollPosition > 1)
		if lastChildSize == 0 then 
			scrollDownButton.Active = false
		else
			scrollDownButton.Active = ((pixelsRemainingY - lastChildSize.Y) < 0)
		end
	end


	local layoutSimpleScrollBar = function()
		local guiObjects = {}	
		
		if orderList then
			for i, child in ipairs(orderList) do
				if child.Parent == frame then
					table.insert(guiObjects, child)
				end
			end
		else
			local children = frame:GetChildren()
			if children then
				for i, child in ipairs(children) do 
					if child:IsA("GuiObject") then
						table.insert(guiObjects, child)
					end
				end
			end
		end
		if #guiObjects == 0 then
			scrollUpButton.Active = false
			scrollDownButton.Active = false
			scrollPosition = 1
			return
		end

		if scrollPosition > #guiObjects then
			scrollPosition = #guiObjects
		end
		
		local totalPixels = frame.AbsoluteSize.Y
		local pixelsRemaining = frame.AbsoluteSize.Y

		local pixelsBelowScrollbar = 0
		local pos = #guiObjects
		while pixelsBelowScrollbar < totalPixels and pos >= 1 do
			if pos >= scrollPosition then
				pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
			else
				if pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y <= totalPixels then
					--It fits, so back up our scroll position
					pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
					if scrollPosition <= 1 then
						scrollPosition = 1
						break
					else
						--print("Backing up ScrollPosition from -- " ..scrollPosition)
						scrollPosition = scrollPosition - 1
					end
				else
					break
				end
			end
			pos = pos - 1
		end

		--print("ScrollPosition = " .. scrollPosition)
		pos = scrollPosition
		for i, child in ipairs(guiObjects) do
			if i < scrollPosition then
				--print("Hiding " .. child.Name)
				child.Visible = false
			else
				if pixelsRemaining < 0 then
					--print("Out of Space " .. child.Name)
					child.Visible = false
				else
					--print("Laying out " .. child.Name)
					--GuiObject
					child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
					pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y
					child.Visible = (pixelsRemaining >= 0)				
				end
			end
		end
		scrollUpButton.Active = (scrollPosition > 1)
		scrollDownButton.Active = (pixelsRemaining < 0)
	end

	local reentrancyGuard = false
	local recalculate = function()
		if reentrancyGuard then
			return
		end
		reentrancyGuard = true
		wait()
		local success, err = nil
		if style == "grid" then
			success, err = pcall(function() layoutGridScrollBar(frame) end)
		elseif style == "simple" then
			success, err = pcall(function() layoutSimpleScrollBar(frame) end)
		end
		if not success then print(err) end

		reentrancyGuard = false
	end

	local scrollUp = function()
		if scrollUpButton.Active then
			scrollPosition = scrollPosition - rowSize
			recalculate()
		end
	end

	local scrollDown = function()
		if scrollDownButton.Active then
			scrollPosition = scrollPosition + rowSize
			recalculate()
		end
	end

	local scrollMouseCount = 0
	scrollUpButton.MouseButton1Click:connect(
		function()
			--print("Up-MouseButton1Click")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollUpButton.MouseLeave:connect(
		function()
			--print("Up-Leave")
			scrollMouseCount = scrollMouseCount + 1
		end)

	scrollUpButton.MouseButton1Down:connect(
		function()
			--print("Up-Down")
			scrollMouseCount = scrollMouseCount + 1

			scrollUp()
			local val = scrollMouseCount
			wait(0.5)
			while val == scrollMouseCount do
				if scrollUp() == false then
					break
				end
				wait(0.1)
			end				
		end)

	scrollDownButton.MouseButton1Click:connect(
		function()
			--print("Down-Click")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollDownButton.MouseLeave:connect(
		function()
			--print("Down-Leave")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollDownButton.MouseButton1Down:connect(
		function()
			--print("Down-Down")
			scrollMouseCount = scrollMouseCount + 1

			scrollDown()
			local val = scrollMouseCount
			wait(0.5)
			while val == scrollMouseCount do
				if scrollDown() == false then
					break
				end
				wait(0.1)
			end				
		end)


	frame.ChildAdded:connect(function()
		recalculate()
	end)

	frame.ChildRemoved:connect(function()
		recalculate()
	end)
	
	frame.Changed:connect(
		function(prop)
			if prop == "AbsoluteSize" then
				--Wait a heartbeat for it to sync in
				recalculate()
			end
		end)
	frame.AncestryChanged:connect(recalculate)

	return frame, scrollUpButton, scrollDownButton, recalculate
end
local function binaryGrow(min, max, fits)
	if min > max then
		return min
	end
	local biggestLegal = min

	while min <= max do
		local mid = min + math.floor((max - min) / 2)
		if fits(mid) and (biggestLegal == nil or biggestLegal < mid) then
			biggestLegal = mid
			
			--Try growing
			min = mid + 1
		else
			--Doesn't fit, shrink
			max = mid - 1
		end
	end
	return biggestLegal
end


local function binaryShrink(min, max, fits)
	if min > max then
		return min
	end
	local smallestLegal = max

	while min <= max do
		local mid = min + math.floor((max - min) / 2)
		if fits(mid) and (smallestLegal == nil or smallestLegal > mid) then
			smallestLegal = mid
			
			--It fits, shrink
			max = mid - 1			
		else
			--Doesn't fit, grow
			min = mid + 1
		end
	end
	return smallestLegal
end


local function getGuiOwner(instance)
	while instance ~= nil do
		if instance:IsA("ScreenGui") or instance:IsA("BillboardGui")  then
			return instance
		end
		instance = instance.Parent
	end
	return nil
end

RbxGuiLib.AutoTruncateTextObject = function(textLabel)
	local text = textLabel.Text

	local fullLabel = textLabel:Clone()
	fullLabel.Name = "Full" .. textLabel.Name 
	fullLabel.BorderSizePixel = 0
	fullLabel.BackgroundTransparency = 0
	fullLabel.Text = text
	fullLabel.TextXAlignment = Enum.TextXAlignment.Center
	fullLabel.Position = UDim2.new(0,-3,0,0)
	fullLabel.Size = UDim2.new(0,100,1,0)
	fullLabel.Visible = false
	fullLabel.Parent = textLabel

	local shortText = nil
	local mouseEnterConnection = nil
	local mouseLeaveConnection= nil

	local checkForResize = function()
		if getGuiOwner(textLabel) == nil then
			return
		end
		textLabel.Text = text
		if textLabel.TextFits then 
			--Tear down the rollover if it is active
			if mouseEnterConnection then
				mouseEnterConnection:disconnect()
				mouseEnterConnection = nil
			end
			if mouseLeaveConnection then
				mouseLeaveConnection:disconnect()
				mouseLeaveConnection = nil
			end
		else
			local len = string.len(text)
			textLabel.Text = text .. "~"

			--Shrink the text
			local textSize = binaryGrow(0, len, 
				function(pos)
					if pos == 0 then
						textLabel.Text = "~"
					else
						textLabel.Text = string.sub(text, 1, pos) .. "~"
					end
					return textLabel.TextFits
				end)
			shortText = string.sub(text, 1, textSize) .. "~"
			textLabel.Text = shortText
			
			--Make sure the fullLabel fits
			if not fullLabel.TextFits then
				--Already too small, grow it really bit to start
				fullLabel.Size = UDim2.new(0, 10000, 1, 0)
			end
			
			--Okay, now try to binary shrink it back down
			local fullLabelSize = binaryShrink(textLabel.AbsoluteSize.X,fullLabel.AbsoluteSize.X, 
				function(size)
					fullLabel.Size = UDim2.new(0, size, 1, 0)
					return fullLabel.TextFits
				end)
			fullLabel.Size = UDim2.new(0,fullLabelSize+6,1,0)

			--Now setup the rollover effects, if they are currently off
			if mouseEnterConnection == nil then
				mouseEnterConnection = textLabel.MouseEnter:connect(
					function()
						fullLabel.ZIndex = textLabel.ZIndex + 1
						fullLabel.Visible = true
						--textLabel.Text = ""
					end)
			end
			if mouseLeaveConnection == nil then
				mouseLeaveConnection = textLabel.MouseLeave:connect(
					function()
						fullLabel.Visible = false
						--textLabel.Text = shortText
					end)
			end
		end
	end
	textLabel.AncestryChanged:connect(checkForResize)
	textLabel.Changed:connect(
		function(prop) 
			if prop == "AbsoluteSize" then 
				checkForResize() 	
			end 
		end)

	checkForResize()

	local function changeText(newText)
		text = newText
		fullLabel.Text = text
		checkForResize()
	end

	return textLabel, changeText
end

local function TransitionTutorialPages(fromPage, toPage, transitionFrame, currentPageValue)	
	if fromPage then
		fromPage.Visible = false
		if transitionFrame.Visible == false then
			transitionFrame.Size = fromPage.Size
			transitionFrame.Position = fromPage.Position
		end
	else
		if transitionFrame.Visible == false then
			transitionFrame.Size = UDim2.new(0.0,50,0.0,50)
			transitionFrame.Position = UDim2.new(0.5,-25,0.5,-25)
		end
	end
	transitionFrame.Visible = true
	currentPageValue.Value = nil

	local newsize, newPosition
	if toPage then
		--Make it visible so it resizes
		toPage.Visible = true

		newSize = toPage.Size
		newPosition = toPage.Position

		toPage.Visible = false
	else
		newSize = UDim2.new(0.0,50,0.0,50)
		newPosition = UDim2.new(0.5,-25,0.5,-25)
	end
	transitionFrame:TweenSizeAndPosition(newSize, newPosition, Enum.EasingDirection.InOut, Enum.EasingStyle.Quad, 0.3, true,
		function(state)
			if state == Enum.TweenStatus.Completed then
				transitionFrame.Visible = false
				if toPage then
					toPage.Visible = true
					currentPageValue.Value = toPage
				end
			end
		end)
end

RbxGuiLib.CreateTutorial = function(name, tutorialKey, createButtons)
	local frame = Instance.new("Frame")
	frame.Name = "Tutorial-" .. name
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(0.6, 0, 0.6, 0)
	frame.Position = UDim2.new(0.2, 0, 0.2, 0)

	local transitionFrame = Instance.new("Frame")
	transitionFrame.Name = "TransitionFrame"
	transitionFrame.Style = Enum.FrameStyle.RobloxRound
	transitionFrame.Size = UDim2.new(0.6, 0, 0.6, 0)
	transitionFrame.Position = UDim2.new(0.2, 0, 0.2, 0)
	transitionFrame.Visible = false
	transitionFrame.Parent = frame

	local currentPageValue = Instance.new("ObjectValue")
	currentPageValue.Name = "CurrentTutorialPage"
	currentPageValue.Value = nil
	currentPageValue.Parent = frame

	local boolValue = Instance.new("BoolValue")
	boolValue.Name = "Buttons"
	boolValue.Value = createButtons
	boolValue.Parent = frame

	local pages = Instance.new("Frame")
	pages.Name = "Pages"
	pages.BackgroundTransparency = 1
	pages.Size = UDim2.new(1,0,1,0)
	pages.Parent = frame

	local function getVisiblePageAndHideOthers()
		local visiblePage = nil
		local children = pages:GetChildren()
		if children then
			for i,child in ipairs(children) do
				if child.Visible then
					if visiblePage then
						child.Visible = false
					else
						visiblePage = child
					end
				end
			end
		end
		return visiblePage
	end

	local showTutorial = function(alwaysShow)
		if alwaysShow or UserSettings().GameSettings:GetTutorialState(tutorialKey) == false then
			print("Showing tutorial-",tutorialKey)
			local currentTutorialPage = getVisiblePageAndHideOthers()

			local firstPage = pages:FindFirstChild("TutorialPage1")
			if firstPage then
				TransitionTutorialPages(currentTutorialPage, firstPage, transitionFrame, currentPageValue)	
			else
				error("Could not find TutorialPage1")
			end
		end
	end

	local dismissTutorial = function()
		local currentTutorialPage = getVisiblePageAndHideOthers()

		if currentTutorialPage then
			TransitionTutorialPages(currentTutorialPage, nil, transitionFrame, currentPageValue)
		end

		UserSettings().GameSettings:SetTutorialState(tutorialKey, true)
	end

	local gotoPage = function(pageNum)
		local page = pages:FindFirstChild("TutorialPage" .. pageNum)
		local currentTutorialPage = getVisiblePageAndHideOthers()
		TransitionTutorialPages(currentTutorialPage, page, transitionFrame, currentPageValue)
	end

	return frame, showTutorial, dismissTutorial, gotoPage
end 

local function CreateBasicTutorialPage(name, handleResize, skipTutorial)
	local frame = Instance.new("Frame")
	frame.Name = "TutorialPage"
	frame.Style = Enum.FrameStyle.RobloxRound
	frame.Size = UDim2.new(0.6, 0, 0.6, 0)
	frame.Position = UDim2.new(0.2, 0, 0.2, 0)
	frame.Visible = false
	
	local frameHeader = Instance.new("TextLabel")
	frameHeader.Name = "Header"
	frameHeader.Text = name
	frameHeader.BackgroundTransparency = 1
	frameHeader.FontSize = Enum.FontSize.Size24
	frameHeader.Font = Enum.Font.ArialBold
	frameHeader.TextColor3 = Color3.new(1,1,1)
	frameHeader.TextXAlignment = Enum.TextXAlignment.Center
	frameHeader.TextWrap = true
	frameHeader.Size = UDim2.new(1,-55, 0, 22)
	frameHeader.Position = UDim2.new(0,0,0,0)
	frameHeader.Parent = frame

	local skipButton = Instance.new("ImageButton")
	skipButton.Name = "SkipButton"
	skipButton.AutoButtonColor = false
	skipButton.BackgroundTransparency = 1
	skipButton.Image = "rbxasset://textures/ui/Skip.png"	
	skipButton.MouseButton1Click:connect(function()
		skipButton.Image = "rbxasset://textures/ui/Skip.png"	
		skipTutorial()
	end)
	skipButton.MouseEnter:connect(function()
		skipButton.Image = "rbxasset://textures/ui/SkipEnter.png"	
	end)
	skipButton.MouseLeave:connect(function()
		skipButton.Image = "rbxasset://textures/ui/Skip.png"	
	end)
	skipButton.Size = UDim2.new(0, 55, 0, 22)
	skipButton.Position = UDim2.new(1, -55, 0, 0)
	skipButton.Parent = frame

	local innerFrame = Instance.new("Frame")
	innerFrame.Name = "ContentFrame"
	innerFrame.BackgroundTransparency = 1
	innerFrame.Position = UDim2.new(0,0,0,22)
	innerFrame.Parent = frame

	local nextButton = Instance.new("TextButton")
	nextButton.Name = "NextButton"
	nextButton.Text = "Next"
	nextButton.TextColor3 = Color3.new(1,1,1)
	nextButton.Font = Enum.Font.Arial
	nextButton.FontSize = Enum.FontSize.Size18
	nextButton.Style = Enum.ButtonStyle.RobloxButtonDefault
	nextButton.Size = UDim2.new(0,80, 0, 32)
	nextButton.Position = UDim2.new(0.5, 5, 1, -32)
	nextButton.Active = false
	nextButton.Visible = false
	nextButton.Parent = frame

	local prevButton = Instance.new("TextButton")
	prevButton.Name = "PrevButton"
	prevButton.Text = "Previous"
	prevButton.TextColor3 = Color3.new(1,1,1)
	prevButton.Font = Enum.Font.Arial
	prevButton.FontSize = Enum.FontSize.Size18
	prevButton.Style = Enum.ButtonStyle.RobloxButton
	prevButton.Size = UDim2.new(0,80, 0, 32)
	prevButton.Position = UDim2.new(0.5, -85, 1, -32)
	prevButton.Active = false
	prevButton.Visible = false
	prevButton.Parent = frame

	innerFrame.Size = UDim2.new(1,0,1,-22-35)

	local parentConnection = nil

	local function basicHandleResize()
		if frame.Visible and frame.Parent then
			local maxSize = math.min(frame.Parent.AbsoluteSize.X, frame.Parent.AbsoluteSize.Y)
			handleResize(200,maxSize)
		end
	end

	frame.Changed:connect(
		function(prop)
			if prop == "Parent" then
				if parentConnection ~= nil then
					parentConnection:disconnect()
					parentConnection = nil
				end
				if frame.Parent and frame.Parent:IsA("GuiObject") then
					parentConnection = frame.Parent.Changed:connect(
						function(parentProp)
							if parentProp == "AbsoluteSize" then
								wait()
								basicHandleResize()
							end
						end)
					basicHandleResize()
				end
			end

			if prop == "Visible" then 
				basicHandleResize()
			end
		end)

	return frame, innerFrame
end

RbxGuiLib.CreateTextTutorialPage = function(name, text, skipTutorialFunc)
	local frame = nil
	local contentFrame = nil

	local textLabel = Instance.new("TextLabel")
	textLabel.BackgroundTransparency = 1
	textLabel.TextColor3 = Color3.new(1,1,1)
	textLabel.Text = text
	textLabel.TextWrap = true
	textLabel.TextXAlignment = Enum.TextXAlignment.Left
	textLabel.TextYAlignment = Enum.TextYAlignment.Center
	textLabel.Font = Enum.Font.Arial
	textLabel.FontSize = Enum.FontSize.Size14
	textLabel.Size = UDim2.new(1,0,1,0)

	local function handleResize(minSize, maxSize)
		size = binaryShrink(minSize, maxSize,
			function(size)
				frame.Size = UDim2.new(0, size, 0, size)
				return textLabel.TextFits
			end)
		frame.Size = UDim2.new(0, size, 0, size)
		frame.Position = UDim2.new(0.5, -size/2, 0.5, -size/2)
	end

	frame, contentFrame = CreateBasicTutorialPage(name, handleResize, skipTutorialFunc)
	textLabel.Parent = contentFrame

	return frame
end

RbxGuiLib.CreateImageTutorialPage = function(name, imageAsset, x, y, skipTutorialFunc)
	local frame = nil
	local contentFrame = nil

	local imageLabel = Instance.new("ImageLabel")
	imageLabel.BackgroundTransparency = 1
	imageLabel.Image = imageAsset
	imageLabel.Size = UDim2.new(0,x,0,y)
	imageLabel.Position = UDim2.new(0.5,-x/2,0.5,-y/2)

	local function handleResize(minSize, maxSize)
		size = binaryShrink(minSize, maxSize,
			function(size)
				return size >= x and size >= y
			end)
		if size >= x and size >= y then
			imageLabel.Size = UDim2.new(0,x, 0,y)
			imageLabel.Position = UDim2.new(0.5,-x/2, 0.5, -y/2)
		else
			if x > y then
				--X is limiter, so 
				imageLabel.Size = UDim2.new(1,0,y/x,0)
				imageLabel.Position = UDim2.new(0,0, 0.5 - (y/x)/2, 0)
			else
				--Y is limiter
				imageLabel.Size = UDim2.new(x/y,0,1, 0)
				imageLabel.Position = UDim2.new(0.5-(x/y)/2, 0, 0, 0)
			end
		end
		frame.Size = UDim2.new(0, size, 0, size)
		frame.Position = UDim2.new(0.5, -size/2, 0.5, -size/2)
	end

	frame, contentFrame = CreateBasicTutorialPage(name, handleResize, skipTutorialFunc)
	imageLabel.Parent = contentFrame

	return frame
end

RbxGuiLib.AddTutorialPage = function(tutorial, tutorialPage)
	local transitionFrame = tutorial.TransitionFrame
	local currentPageValue = tutorial.CurrentTutorialPage

	if not tutorial.Buttons.Value then
		tutorialPage.ContentFrame.Size = UDim2.new(1,0,1,-22)
		tutorialPage.NextButton.Parent = nil
		tutorialPage.PrevButton.Parent = nil
	end

	local children = tutorial.Pages:GetChildren()
	if children and #children > 0 then
		tutorialPage.Name = "TutorialPage" .. (#children+1)
		local previousPage = children[#children]
		if not previousPage:IsA("GuiObject") then
			error("All elements under Pages must be GuiObjects")
		end

		if tutorial.Buttons.Value then
			if previousPage.NextButton.Active then
				error("NextButton already Active on previousPage, please only add pages with RbxGui.AddTutorialPage function")
			end
			previousPage.NextButton.MouseButton1Click:connect(
				function()
					TransitionTutorialPages(previousPage, tutorialPage, transitionFrame, currentPageValue)
				end)
			previousPage.NextButton.Active = true
			previousPage.NextButton.Visible = true

			if tutorialPage.PrevButton.Active then
				error("PrevButton already Active on tutorialPage, please only add pages with RbxGui.AddTutorialPage function")
			end
			tutorialPage.PrevButton.MouseButton1Click:connect(
				function()
					TransitionTutorialPages(tutorialPage, previousPage, transitionFrame, currentPageValue)
				end)
			tutorialPage.PrevButton.Active = true
			tutorialPage.PrevButton.Visible = true
		end

		tutorialPage.Parent = tutorial.Pages
	else
		--First child
		tutorialPage.Name = "TutorialPage1"
		tutorialPage.Parent = tutorial.Pages
	end
end 

RbxGuiLib.Help = 
	function(funcNameOrFunc) 
		--input argument can be a string or a function.  Should return a description (of arguments and expected side effects)
		if funcNameOrFunc == "CreatePropertyDropDownMenu" or funcNameOrFunc == RbxGuiLib.CreatePropertyDropDownMenu then
			return "Function CreatePropertyDropDownMenu.  " ..
				   "Arguments: (instance, propertyName, enumType).  " .. 
				   "Side effect: returns a container with a drop-down-box that is linked to the 'property' field of 'instance' which is of type 'enumType'" 
		end 
		if funcNameOrFunc == "CreateDropDownMenu" or funcNameOrFunc == RbxGuiLib.CreateDropDownMenu then
			return "Function CreateDropDownMenu.  " .. 
			       "Arguments: (items, onItemSelected).  " .. 
				   "Side effect: Returns 2 results, a container to the gui object and a 'updateSelection' function for external updating.  The container is a drop-down-box created around a list of items" 
		end 
		if funcNameOrFunc == "CreateMessageDialog" or funcNameOrFunc == RbxGuiLib.CreateMessageDialog then
			return "Function CreateMessageDialog.  " .. 
			       "Arguments: (title, message, buttons). " .. 
			       "Side effect: Returns a gui object of a message box with 'title' and 'message' as passed in.  'buttons' input is an array of Tables contains a 'Text' and 'Function' field for the text/callback of each button"
		end		
		if funcNameOrFunc == "CreateStyledMessageDialog" or funcNameOrFunc == RbxGuiLib.CreateStyledMessageDialog then
			return "Function CreateStyledMessageDialog.  " .. 
			       "Arguments: (title, message, style, buttons). " .. 
			       "Side effect: Returns a gui object of a message box with 'title' and 'message' as passed in.  'buttons' input is an array of Tables contains a 'Text' and 'Function' field for the text/callback of each button, 'style' is a string, either Error, Notify or Confirm"
		end
		if funcNameOrFunc == "GetFontHeight" or funcNameOrFunc == RbxGuiLib.GetFontHeight then
			return "Function GetFontHeight.  " .. 
			       "Arguments: (font, fontSize). " .. 
			       "Side effect: returns the size in pixels of the given font + fontSize"
		end
		if funcNameOrFunc == "LayoutGuiObjects" or funcNameOrFunc == RbxGuiLib.LayoutGuiObjects then
		
		end
		if funcNameOrFunc == "CreateScrollingFrame" or funcNameOrFunc == RbxGuiLib.CreateScrollingFrame then
			return "Function CreateScrollingFrame.  " .. 
			   "Arguments: (orderList, style) " .. 
			   "Side effect: returns 4 objects, (scrollFrame, scrollUpButton, scrollDownButton, recalculateFunction).  'scrollFrame' can be filled with GuiObjects.  It will lay them out and allow scrollUpButton/scrollDownButton to interact with them.  Orderlist is optional (and specifies the order to layout the children.  Without orderlist, it uses the children order. style is also optional, and allows for a 'grid' styling if style is passed 'grid' as a string.  recalculateFunction can be called when a relayout is needed (when orderList changes)"
		end
		if funcNameOrFunc == "AutoTruncateTextObject" or funcNameOrFunc == RbxGuiLib.AutoTruncateTextObject then
			return "Function AutoTruncateTextObject.  " .. 
			   "Arguments: (textLabel) " .. 
			   "Side effect: returns 2 objects, (textLabel, changeText).  The 'textLabel' input is modified to automatically truncate text (with ellipsis), if it gets too small to fit.  'changeText' is a function that can be used to change the text, it takes 1 string as an argument"
		end
		if funcNameOrFunc == "CreateSlider" or funcNameOrFunc == RbxGuiLib.CreateSlider then
			return "Function CreateSlider.  " ..
				"Arguments: (steps, width, position) " ..
				"Side effect: returns 2 objects, (sliderGui, sliderPosition).  The 'steps' argument specifies how many different positions the slider can hold along the bar.  'width' specifies in pixels how wide the bar should be (modifiable afterwards if desired). 'position' argument should be a UDim2 for slider positioning. 'sliderPosition' is an IntValue whose current .Value specifies the specific step the slider is currently on."
		end
	end
-- RBXGUI END --

delay(0, function()

local RbxGui

local localTesting = true

local screen = game:GetService("CoreGui").RobloxGui
local screenResizeCon = nil

local friendWord = "Friend"
local friendWordLowercase = "friend"

local testFriendingPlaces = {}
testFriendingPlaces[41324860] = true
local enableFriendingGlobally = true

local testPlayerListPlaces = {}
testPlayerListPlaces[41324860] = true
testPlayerListPlaces[10042455] = true
local enablePlayerListGlobally = true

local bigEasingStyle = Enum.EasingStyle.Back
local smallEasingStyle = Enum.EasingStyle.Quart
local lightBackground = true

local function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end

local function waitForProperty(instance, prop)
	while not instance[prop] do
		instance.Changed:wait()
	end
end

local function Color3I(r,g,b)
  return Color3.new(r/255,g/255,b/255)
end

function robloxLock(instance)
  instance.RobloxLocked = true
  children = instance:GetChildren()
  if children then
	 for i, child in ipairs(children) do
		robloxLock(child)
	 end
  end
end

function ArrayRemove(t, obj)
	for i, obj2 in ipairs(t) do
		if obj == obj2 then
			table.remove(t, i)
			return true
		end
	end
	return false
end

local function getPlayers()
	local result = {}
   local players = game:GetService("Players"):GetChildren()
	if players then
		for i, player in ipairs(players) do
			if player:IsA("Player") then 
				table.insert(result, player)
			end
		end
	end
	return result
end

local brickColorTable = {}
for i = 0, 63 do
   brickColorTable[BrickColor.palette(i).Name] = BrickColor.palette(i).Color
end

local function remapColor(i, j)
  brickColorTable[BrickColor.palette(i).Name] = BrickColor.palette(j).Color
end

remapColor(13, 12)
remapColor(14, 12)
remapColor(15, 12)
remapColor(61, 29)
remapColor(63, 62)
remapColor(56, 50)
remapColor(45, 53)
remapColor(51, 20)
remapColor(4, 20)
remapColor(59, 35)
remapColor(60, 29)

local function getColor(brickColor)
  if brickColorTable[brickColor.Name] then
	return brickColorTable[brickColor.Name] 
  else
    return brickColor.Color;
  end
end



local function getTeams()
	local result = {}
	local teams = game:GetService("Teams"):GetChildren()
	for i, team in ipairs(teams) do
		if team:IsA("Team") then 
			table.insert(result, team)
		end
	end
	return result	
end

local supportFriends = true
local currentBoardType = "PlayerList"
local currentStatCount = 0

local createBoardsFunction = nil


local playerTable = {}
local teamTable = {}
local teamColorTable	= {}

local removePlayerFunction = nil
local recreatePlayerFunction = nil
local addPlayerFunction = function(player)
	if recreatePlayerFunction then
		recreatePlayerFunction(player)
	end
end
local sortPlayerListsFunction = nil

local minimizedState = nil
local bigWindowImposter = nil
local smallWindowPosition = UDim2.new(0, -20, 0,5)
local smallWindowSize = UDim2.new(1,0,1,0)
local bigWindowSize = UDim2.new(0.6,0,0.6,0) 
local bigWindowPosition = UDim2.new(.2, 0, .2,0)

local smallWindowHeaderYSize = 32

local debounceTeamsChanged = false

local currentWindowState = "Small"
local previousWindowState = nil
local transitionWindowsFunction = nil

local container = nil
local topRightTrayContainer = nil

local playerContextMenu = nil
local contextMenuElements = {}

local function addContextMenuLabel(getText1, getText2, isVisible)
	local t = {}
	t.Type = "Label"
	t.GetText1 = getText1
	t.GetText2 = getText2
	t.IsVisible = isVisible
	table.insert(contextMenuElements, t)
end
local function addContextMenuButton(text, isVisible, isActive, doIt)
	local t = {}
	t.Text = text
	t.Type = "Button"
	t.IsVisible = isVisible
	t.IsActive = isActive
	t.DoIt = doIt
	table.insert(contextMenuElements, t)
end

local function getFriendStatus(player)
	if player == game.Players.LocalPlayer then
		return Enum.FriendStatus.NotFriend
	else
		local success, result = pcall(function() return game.Players.LocalPlayer:GetFriendStatus(player) end)
		if success then
			return result
		else
			return Enum.FriendStatus.NotFriend
		end
	end
end
--Populate the ContextMenus
addContextMenuLabel(
	--GetText1
	function(player) 
		return "Loading..."
	end,
	--GetText2
	nil,
	--IsVisible
	function(player) 
		return getFriendStatus(player) == Enum.FriendStatus.Unknown
	end)

addContextMenuButton("Send " .. friendWord .. " Request", 
	--IsVisible
	function(player) 
		return getFriendStatus(player) == Enum.FriendStatus.NotFriend
	end, 
	--IsActive
	function(player) 
		return true 
	end, 
	--DoIt
	function(player) 
		return game.Players.LocalPlayer:RequestFriendship(player)
	end
)
addContextMenuButton("Un" .. friendWordLowercase, 
	--IsVisible
	function(player) 
		return getFriendStatus(player) == Enum.FriendStatus.Friend
	end, 
	--IsActive
	function(player) 
		return true 
	end, 
	--DoIt
	function(player) 
		return game.Players.LocalPlayer:RevokeFriendship(player)
	end
)
addContextMenuButton("Accept " .. friendWord .. " Request", 
	--IsVisible
	function(player) 
		return getFriendStatus(player) == Enum.FriendStatus.FriendRequestReceived
	end, 
	--IsActive
	function(player) 
		return true 
	end, 
	--DoIt
	function(player)
		return game.Players.LocalPlayer:RequestFriendship(player)
	end
)

addContextMenuButton("Deny " .. friendWord .. " Request", 
	--IsVisible
	function(player) 
		return getFriendStatus(player) == Enum.FriendStatus.FriendRequestReceived
	end, 
	--IsActive
	function(player) 
		return true 
	end, 
	--DoIt
	function(player) 
		return game.Players.LocalPlayer:RevokeFriendship(player)
	end
)

addContextMenuButton("Cancel " .. friendWord .. " Request", 
	--IsVisible
	function(player) 
		return getFriendStatus(player) == Enum.FriendStatus.FriendRequestSent
	end, 
	--IsActive
	function(player) 
		return true 
	end, 
	--DoIt
	function(player) 
		return game.Players.LocalPlayer:RevokeFriendship(player)
	end
)


local function getStatColumns(players)
	for i, player in ipairs(players) do
		local leaderstats = player:FindFirstChild("leaderstats")
		if leaderstats then
			local stats = {} 
			local children = leaderstats:GetChildren()
			if children then
				for i, stat in ipairs(children) do
					if stat:IsA("IntValue") then
						table.insert(stats, stat.Name)
					else
						--TODO: This should check for IntValue only but current ScoreHud does not
						table.insert(stats, stat.Name)
					end
				end
			end
			return stats
		end		
	end
	return nil
end

local function determineBoardType()
	local players = getPlayers()
	
	local foundLeaderstats = false
	local numStats = 0
	local foundTeam = false

	local stats = getStatColumns(players)
	if stats then
		foundLeaderstats = true
		numStats = #stats
	end

	for i, player in ipairs(players) do
		if not foundTeam then
			if not player.Neutral then
				foundTeam = true
				break
			end
		end
	end
	
	if foundLeaderstats and foundTeam then
		return "TeamScore", numStats
	elseif foundLeaderstats then
		return "PlayerScore", numStats
	elseif foundTeam then
		return "TeamList", numStats
	else
		return "PlayerList", numStats
	end
end

local function toggleBigWindow()
	if container == nil then
		return
	end

	if currentWindowState == "Big" then
		--Hide it
		if previousWindowState == nil or previousWindowState == "Big" or previousWindowState == "None" then
			transitionWindowsFunction("None")
		else
			transitionWindowsFunction("Small")
		end
	else
		previousWindowState = currentWindowState
		transitionWindowsFunction("Big")
	end
end
local previousBigPlayerList = nil
local function rebuildBoard(owner, boardType, numStats)
	if topRightTrayContainer == nil then
		topRightTrayContainer = owner:FindFirstChild("PlayerListTopRightFrame")
		if topRightTrayContainer == nil then
			topRightTrayContainer = Instance.new("Frame")
			topRightTrayContainer.Name = "PlayerListTopRightFrame"
			topRightTrayContainer.BackgroundTransparency = 1
			topRightTrayContainer.Size = UDim2.new(0.2, 16, 0.42, 16)
			topRightTrayContainer.Position = UDim2.new(0.8, 0, 0, 0)
			topRightTrayContainer.Parent = container
		end
	end
	if minimizedState == nil then
		minimizedState = Instance.new("Frame")
		minimizedState.Name = "MinimizedPlayerlist"
		minimizedState.BackgroundTransparency = 1
		minimizedState.Position = UDim2.new(1, -166, 0,0)
		minimizedState.Size = UDim2.new(0, 151, 0, 30)
		
		playerListButton = Instance.new("ImageButton")
		playerListButton.Name = "GoSmallButton"
		playerListButton.Image = "rbxasset://textures/ui/playerlist_hidden_small.png"
		playerListButton.BackgroundTransparency = 1
		playerListButton.Size = UDim2.new(0.0, 35, 0, 30)
		playerListButton.Position = UDim2.new(1, -35, 0, 0)
		playerListButton.MouseButton1Click:connect(
			function()
				transitionWindowsFunction("Small")
			end)
		playerListButton.Parent = minimizedState

		minimizedState.Visible = false
		robloxLock(minimizedState)
		minimizedState.Parent = topRightTrayContainer
	end
	if bigWindowImposter == nil then
		bigWindowImposter = owner:FindFirstChild("BigPlayerListWindowImposter")
		if bigWindowImposter == nil then
			bigWindowImposter = Instance.new("Frame")
			bigWindowImposter.Name = "BigPlayerListWindowImposter"
			bigWindowImposter.Visible = false
			bigWindowImposter.BackgroundColor3 = Color3.new(0,0,0)
			bigWindowImposter.BackgroundTransparency = 0.7
			bigWindowImposter.BorderSizePixel = 0
			bigWindowImposter.Size = UDim2.new(0.4, 7, 0.4, 7)
			bigWindowImposter.Position = UDim2.new(0.3, 0, 0.3, 0)
			robloxLock(bigWindowImposter)
			bigWindowImposter.Parent = container
		end
	end
	if container == nil or container ~= owner then
		container = owner

		topRightTrayContainer.Parent = container
		bigWindowImposter.Parent = container
	end

	local smallVisible = true
	local bigVisible = false
	if container then
		if topRightTrayContainer then
			--Delete the old boards
			if topRightTrayContainer:FindFirstChild("SmallPlayerlist") then
				smallVisible = topRightTrayContainer.SmallPlayerlist.Visible
				topRightTrayContainer.SmallPlayerlist.Parent = nil
			end
		end
		if container:FindFirstChild("BigPlayerlist") then
			bigVisible = container.BigPlayerlist.Visible or (previousBigPlayerList ~= nil)
			container.BigPlayerlist.Parent = nil
			if previousBigPlayerList ~= nil then
				pcall(function() game.GuiService:RemoveCenterDialog(previousBigPlayerList) end)
				previousBigPlayerList = nil
			end
		end
	end

	local smallBoard, bigBoard = createBoardsFunction(boardType, numStats)
	if smallBoard then
		smallBoard.Visible = smallVisible
		smallBoard.Parent = topRightTrayContainer
		recalculateSmallPlayerListSize(smallBoard)
	end
	if bigBoard then
		if bigVisible then
			previousBigPlayerList = bigBoard
			local centerDialogSupported, msg = pcall(function() game.GuiService:AddCenterDialog(previousBigPlayerList, Enum.CenterDialogType.PlayerInitiatedDialog, 
				function()
					previousBigPlayerList.Visible = true
				end)
			end)
			bigBoard.Visible = bigVisible
		else
			bigBoard.Visible = false
		end
		bigBoard.Parent = container
	end
	return container
end

function recalculateSmallPlayerListSize(smallPlayerList)
	waitForChild(smallPlayerList,"ScrollingArea")
	waitForChild(smallPlayerList.ScrollingArea, "ScrollingFrame")
	local scrollingFrame = smallPlayerList.ScrollingArea.ScrollingFrame
	local playerLines = scrollingFrame:GetChildren()

	local totalPlayerListSize = 0
	for i = 1, #playerLines do
		totalPlayerListSize = totalPlayerListSize + playerLines[i].AbsoluteSize.Y
	end

	local yOffset = math.max(0,(smallPlayerList.Size.Y.Scale * smallPlayerList.Parent.AbsoluteSize.Y) - totalPlayerListSize - smallWindowHeaderYSize)
	smallPlayerList.Size = UDim2.new(smallPlayerList.Size.X.Scale,smallPlayerList.Size.X.Offset,smallPlayerList.Size.Y.Scale,-yOffset)
end


local function showBigPlayerWindow()
	if container:FindFirstChild("BigPlayerlist") then
		if container.BigPlayerlist.Visible then
			return
		end
	end
	
	bigWindowImposter.Visible = true
	bigWindowImposter:TweenSizeAndPosition(bigWindowSize, bigWindowPosition, Enum.EasingDirection.Out, bigEasingStyle, 0.3, true,
		function(state)
			if state == Enum.TweenStatus.Completed then 
				bigWindowImposter.Visible = false 
				if container:FindFirstChild("BigPlayerlist") then
					container.BigPlayerlist.Visible = true
				end		
			end
		end)
end

local function hideBigPlayerWindow(completed)
	if playerContextMenu then
		playerContextMenu.Visible = false
	end
	
	if container:FindFirstChild("BigPlayerlist") then
		if container.BigPlayerlist.Visible == false and bigWindowImposter.Visible == false then
			if completed then
				completed()
			end
			--Already completely hidden
			return
		end
		container.BigPlayerlist.Visible = false
	end

	local completedFunction = completed
	bigWindowImposter.Visible = true
	bigWindowImposter:TweenSizeAndPosition(UDim2.new(0.4, 0, 0.4, 0), UDim2.new(0.3, 0, 0.3, 0), Enum.EasingDirection.In, Enum.EasingStyle.Quart, 0.15, true,
		function(state) 
			if state == Enum.TweenStatus.Completed then 
				bigWindowImposter.Visible = false 
				if completedFunction then
					completedFunction()
				end
			end
		end)
end
local function hideSmallPlayerWindow(completed)
	if playerContextMenu then
		playerContextMenu.Visible = false
	end
	if topRightTrayContainer:FindFirstChild("SmallPlayerlist") then
		local completedFunction = completed
		if topRightTrayContainer.SmallPlayerlist.Visible then
			topRightTrayContainer.SmallPlayerlist:TweenPosition(UDim2.new(1,0,smallWindowPosition.Y.Scale, smallWindowPosition.Y.Offset), Enum.EasingDirection.Out, smallEasingStyle, 0.3, true, 
				function(state) 
					if state == Enum.TweenStatus.Completed then 
						if topRightTrayContainer:FindFirstChild("SmallPlayerlist") then
							topRightTrayContainer.SmallPlayerlist.Visible = false
						end
						if completedFunction then
							completedFunction()
						end
					end
				end)
			return
		end
	end
	if completed then
		completed()
	end
end


transitionWindowsFunction = function(desiredState)
	if desiredState == "Big" then
		minimizedState.Visible = false
		hideSmallPlayerWindow()
	
		if previousBigPlayerList ~= nil then
			if previousBigPlayerList ~= container:FindFirstChild("BigPlayerlist") then
				pcall(function() game.GuiService:RemoveCenterDialog(previousBigPlayerList) end)
				previousBigPlayerList = nil
				previousBigPlayerList = container:FindFirstChild("BigPlayerlist")
			end
		else
			previousBigPlayerList = container:FindFirstChild("BigPlayerlist")
		end

		if previousBigPlayerList then
			local firstShow = false
			local centerDialogSupported, msg = pcall(function() game.GuiService:AddCenterDialog(previousBigPlayerList, Enum.CenterDialogType.PlayerInitiatedDialog, 
				function()
					if not firstShow then
						showBigPlayerWindow()
						firstShow = true
					else
						previousBigPlayerList.Visible = true
					end
				end)
			end)
			if centerDialogSupported == false then
				print("Exception", msg)
				showBigPlayerWindow()
			end
		else
			showBigPlayerWindow()
		end
		currentWindowState = "Big"
	elseif desiredState == "Small" then
		minimizedState.Visible = false
		if previousBigPlayerList ~= nil then
			pcall(function() game.GuiService:RemoveCenterDialog(previousBigPlayerList) end)
			previousBigPlayerList = nil
		end
		
		hideBigPlayerWindow()
		if topRightTrayContainer:FindFirstChild("SmallPlayerlist") then
			if not topRightTrayContainer.SmallPlayerlist.Visible or topRightTrayContainer.SmallPlayerlist.Position ~= smallWindowPosition then
				topRightTrayContainer.SmallPlayerlist.Visible = true
				topRightTrayContainer.SmallPlayerlist:TweenPosition(smallWindowPosition, Enum.EasingDirection.Out, smallEasingStyle, 0.3, true)
			end
		end
		currentWindowState = "Small"
	elseif desiredState == "None" then
		if previousBigPlayerList ~= nil then
			pcall(function() game.GuiService:RemoveCenterDialog(previousBigPlayerList) end)
			previousBigPlayerList = nil
		end
		
		local smallDone = false
		local bigDone = false
		hideSmallPlayerWindow(
			function() 
				smallDone = true 
				if bigDone and smallDone then
					minimizedState.Visible = true
				end
			end)
		hideBigPlayerWindow(			
			function() 
				bigDone = true 
				if bigDone and smallDone then
					minimizedState.Visible = true
				end
			end)		
		currentWindowState = "None"
	end
end

local function getStatValuesForPlayer(player)
	local leaderstats = player:FindFirstChild("leaderstats")
	if leaderstats then
		local children = leaderstats:GetChildren()
		if children then
			local result = {}
			--Just go based on position
			for i, stat in ipairs(children) do
				if stat:IsA("IntValue") then
					table.insert(result, stat)
				else 
					table.insert(result, 0)
				end
			end

			return result, leaderstats
		end
	end
	return nil
end

--ChildAdded on Player (if it's name is "leaderstats")

if UserSettings and LoadLibrary then

	RbxGui,msg = RbxGuiLib

	local function createTeamName(name, color)
		local fontHeight = 20
		local frame = Instance.new("Frame")
		frame.Name = "Team-" .. name
		frame.BorderSizePixel = 0
		frame.BackgroundTransparency = 0.5
		frame.BackgroundColor3 = Color3.new(1,1,1)
		frame.Size = UDim2.new(1, 0, 0, fontHeight)
		frame.Position = UDim2.new(0,0,0,0)

		local label = Instance.new("TextLabel")
		label.Name = "NameLabel"
		label.Text = " " .. name
		label.Font = Enum.Font.ArialBold
		label.FontSize = Enum.FontSize.Size18
		label.Position = UDim2.new(0,0,0,0)
		label.Size = UDim2.new(1,0,1,0)
		label.TextColor3 = Color3.new(1,1,1)
		label.BackgroundTransparency = 0.5
		label.BackgroundColor3 = getColor(color)
		label.BorderSizePixel = 0
		label.TextXAlignment = Enum.TextXAlignment.Left
		label = RbxGui.AutoTruncateTextObject(label)
		label.Parent = frame
		
		return frame
	end

	local function getFriendStatusIcon(friendStatus)
		if friendStatus == Enum.FriendStatus.Unknown or friendStatus == Enum.FriendStatus.NotFriend then
			return nil
		elseif friendStatus == Enum.FriendStatus.Friend then
			return "rbxasset://textures/ui/PlayerlistFriendIcon.png"
		elseif friendStatus == Enum.FriendStatus.FriendRequestSent then
			return "rbxasset://textures/ui/PlayerlistFriendRequestSentIcon.png"
		elseif friendStatus == Enum.FriendStatus.FriendRequestReceived then
			return "rbxasset://textures/ui/PlayerlistFriendRequestReceivedIcon.png"
		else
			error("Unknown FriendStatus: " .. friendStatus)
		end
	end

	local function getMembershipTypeIcon(membershipType, playerName)
		if membershipType == Enum.MembershipType.None then
			return "rbxasset://../../../shareddata/charcustom/custom/icons/"..playerName..".png"
		elseif membershipType == Enum.MembershipType.BuildersClub then
			return "rbxasset://textures/ui/TinyBcIcon.png"
		elseif membershipType == Enum.MembershipType.TurboBuildersClub then
			return "rbxasset://textures/ui/TinyTbcIcon.png"
		elseif membershipType == Enum.MembershipType.OutrageousBuildersClub then
			return "rbxasset://textures/ui/TinyObcIcon.png"
		else
			error("Uknown membershipType" .. membershipType)
		end	
	end

	local function updatePlayerFriendStatus(nameObject, friendStatus)
		local fontHeight = 20

		local friendIconImage = getFriendStatusIcon(friendStatus)
		nameObject.MembershipTypeLabel.FriendStatusLabel.Visible = (friendIconImage ~= nil)

		if friendIconImage ~= nil then 
			--Show friend icon
			nameObject.MembershipTypeLabel.FriendStatusLabel.Image = friendIconImage
			nameObject.NameLabel.Position =UDim2.new(0,2*fontHeight,0,1)
			nameObject.NameLabel.Size = UDim2.new(1,-2*fontHeight,1,-2)
		else
			--Hide the friend icon
			nameObject.NameLabel.Position = UDim2.new(0,fontHeight+1,0,1)
			nameObject.NameLabel.Size = UDim2.new(1,-(fontHeight+1),1,-2)
		end
	end
	local function updatePlayerName(nameObject, membershipStatus, teamColor)
		local fontHeight = 20
		
		local playerName = nameObject.NameLabel.Text
		
		nameObject.Size = UDim2.new(1,0,0,fontHeight)
		nameObject.MembershipTypeLabel.Image = getMembershipTypeIcon(membershipStatus, playerName)
	end

	
	local function updatePlayerNameColor(player, teamColor)
		local function updatePlayerNameColorHelper(nameObject)
			if teamColor ~= nil then
				nameObject.NameLabel.TextColor3 = getColor(teamColor)
				nameObject.NameLabel.FullNameLabel.TextColor3 = getColor(teamColor)
			else
				nameObject.NameLabel.TextColor3 = Color3.new(1,1,1)
				nameObject.NameLabel.FullNameLabel.TextColor3 = Color3.new(1,1,1)
			end
		end
		
		updatePlayerNameColorHelper(playerTable[player].NameObjectSmall)
		updatePlayerNameColorHelper(playerTable[player].NameObjectBig)
	end


	local function createPlayerName(name, membershipStatus, teamColor, friendStatus)
		local frame = Instance.new("Frame")
		frame.Name = "Player_" .. name
		if lightBackground then
			frame.BackgroundColor3 = Color3.new(1,1,1)
		else
			frame.BackgroundColor3 = Color3.new(1,1,1)
		end
		frame.BackgroundTransparency = 0.5
		frame.BorderSizePixel = 0
		
		local membershipStatusLabel = Instance.new("ImageLabel")
		membershipStatusLabel.Name = "MembershipTypeLabel"
		membershipStatusLabel.BackgroundTransparency = 1
		membershipStatusLabel.Size = UDim2.new(1,0,1,0)
		membershipStatusLabel.Position = UDim2.new(0,0,0,0)
		membershipStatusLabel.SizeConstraint = Enum.SizeConstraint.RelativeYY
		membershipStatusLabel.Parent = frame

		local friendStatusLabel = Instance.new("ImageLabel")
		friendStatusLabel.Name = "FriendStatusLabel"
		friendStatusLabel.Visible = false
		friendStatusLabel.BackgroundTransparency = 1
		friendStatusLabel.Size = UDim2.new(1,0,1,0)
		friendStatusLabel.Position = UDim2.new(1,0,0,0)
		friendStatusLabel.Parent = membershipStatusLabel

		local changeNameFunction
		local nameLabel = Instance.new("TextLabel")
		nameLabel.Name = "NameLabel"
		nameLabel.Text = name
		nameLabel.Font = Enum.Font.ArialBold
		nameLabel.FontSize = Enum.FontSize.Size14
		nameLabel.TextColor3 = Color3.new(1,1,1)
		nameLabel.BackgroundTransparency = 1
		nameLabel.BackgroundColor3 = Color3.new(0,0,0)
		nameLabel.TextXAlignment = Enum.TextXAlignment.Left
		nameLabel, changeNameFunction = RbxGui.AutoTruncateTextObject(nameLabel)
		nameLabel.Parent = frame
		
		updatePlayerName(frame, membershipStatus, teamColor)
		if supportFriends then
			updatePlayerFriendStatus(frame, friendStatus)
		else
			updatePlayerFriendStatus(frame, Enum.FriendStatus.NotFriend)
		end
		return frame, changeNameFunction
	end

	local function createStatColumn(i, numColumns, isTeam, color3, isHeader)
		local textLabel = Instance.new("TextLabel")
		textLabel.Name = "Stat" .. i
		textLabel.TextColor3 = Color3.new(1,1,1)
		textLabel.TextXAlignment = Enum.TextXAlignment.Right
		textLabel.TextYAlignment = Enum.TextYAlignment.Center
		textLabel.FontSize = Enum.FontSize.Size14
		if isHeader then
			textLabel.FontSize = Enum.FontSize.Size18
		else
			textLabel.FontSize = Enum.FontSize.Size14
		end
		if isHeader or isTeam then
			textLabel.Font = Enum.Font.ArialBold
		else 
			textLabel.Font = Enum.Font.Arial
		end

		if isTeam then
			textLabel.BackgroundColor3 = color3
			textLabel.Text = 0
		else
			textLabel.BackgroundColor3 = Color3.new(0,0,0)
			textLabel.Text = ""
		end
		textLabel.BackgroundTransparency = 1
		if i == numColumns then
			textLabel.Size = UDim2.new(1/numColumns, -6, 1, 0)
		else
			textLabel.Size = UDim2.new(1/numColumns, -4, 1, 0)
		end
		
		textLabel.Position = UDim2.new((i-1) * (1/numColumns), 0, 0, 0)
		return RbxGui.AutoTruncateTextObject(textLabel)
	end

	local function createStatHeaders(stats, numColumns, isBig)
		local frame = Instance.new("Frame")
		frame.Name = "Headers"
		frame.BorderSizePixel = 0
		frame.BackgroundColor3 = Color3.new(0,0,0)
		frame.BackgroundTransparency = 1
		
		local nameSize
		if isBig then
			nameSize = 0.5
		elseif numColumns == 1 then
			nameSize = 0.7
		elseif numColumns == 2 then
			nameSize = 0.6
		else
			nameSize = 0.45
		end
		frame.Size = UDim2.new(1-nameSize, 0, 1,0)
		if isBig then
			frame.Position = UDim2.new(nameSize,-25, 0,0)
		else
			frame.Position = UDim2.new(nameSize,0, 0,0)
		end

		local i = 1
		while i <= numColumns do
			local headerColumn, changeText = createStatColumn(i, numColumns, false, nil, true)
			changeText(stats[i])
			headerColumn.Parent = frame
			i = i + 1
		end		
		return frame, textChangers
	end

	local function createStatColumns(nameObject, numColumns, isTeam, isBig) 
		local frame = Instance.new("Frame")
		frame.Name = nameObject.Name .. "_WithStats"
		frame.BorderSizePixel = 0
		frame.BackgroundColor3 = nameObject.BackgroundColor3
		frame.BackgroundTransparency = nameObject.BackgroundTransparency
		frame.Size = nameObject.Size
		frame.Position = nameObject.Position

		nameObject.BackgroundTransparency = 1

		if numColumns == 0 then
			nameObject.Size = UDim2.new(1,0,1,0)
			nameObject.Position = UDim2.new(0,0,0,0)
			nameObject.Parent = frame
			return frame
		end

		local statFrame = Instance.new("Frame")
		statFrame.Name = "Stats"
		if isTeam then
			statFrame.BorderSizePixel = 0
			statFrame.BackgroundColor3 = nameObject.NameLabel.BackgroundColor3
			statFrame.BackgroundTransparency = nameObject.NameLabel.BackgroundTransparency
		else
			statFrame.BackgroundTransparency = 1
		end
		
		local nameSize
		if isBig then
			nameSize = 0.5
		elseif numColumns == 1 then
			nameSize = 0.7
		elseif numColumns == 2 then
			nameSize = 0.6
		else
			nameSize = 0.45
		end
		nameObject.Size = UDim2.new(nameSize, 0, 1, 0)
		nameObject.Position = UDim2.new(0, 0, 0, 0)
		statFrame.Size = UDim2.new(1-nameSize,0, 1,0)
		statFrame.Position = UDim2.new(nameSize,0, 0,0)

		nameObject.Parent = frame
		statFrame.Parent = frame
		
		local textChangers = {}
		local i = 1
		while i <= numColumns do
			local statColumn, changeText = createStatColumn(i, numColumns, isTeam, statFrame.BackgroundColor3)
			statColumn.Parent = statFrame
			table.insert(textChangers, changeText)

			i = i + 1
		end		
		
		return frame, statFrame, textChangers
	end

	local function createAlternatingRows(objects)
		for i, line in ipairs(objects) do
			if i % 2 == 0 then
				line.BackgroundTransparency = 1
			else
				line.BackgroundTransparency = 0.95
			end
		end
	end
	local removeFromTeam = nil

	local function clearTableEntry(obj, tableInfo)
		if tableInfo.MainObjectSmall then
			tableInfo.MainObjectSmall.Parent = nil
			tableInfo.MainObjectSmall = nil
		end
		if tableInfo.MainObjectBig then
			tableInfo.MainObjectBig.Parent = nil
			tableInfo.MainObjectBig = nil
		end
		if tableInfo.Connections then
			for i, connection in ipairs(tableInfo.Connections) do
				connection:disconnect()
			end
			tableInfo.Connections = nil
		end
		if tableInfo.LeaderStatConnections then
			for i, connection in ipairs(tableInfo.LeaderStatConnections) do
				connection:disconnect()
			end
			tableInfo.LeaderStatConnections = nil
		end
		if tableInfo.CurrentTeam then
			removeFromTeam(obj)
			tableInfo.CurrentTeam = nil
		end
		if tableInfo.Players then
			for i, player in ipairs(tableInfo.Players) do
				playerTable[player].CurrentTeam = nil
			end
			tableInfo.Players = {}
		end
		if tableInfo.StatValues then
			tableInfo.StatValues = nil
		end
	end
	
	local function resetPlayerTable()
		for player, info in pairs(playerTable) do
			clearTableEntry(player, info)
			playerTable[player] = nil
		end
		playerTable = {}
	end

	local function resetTeamTable()
		for team, info in pairs(teamTable) do
			clearTableEntry(team, info)
			teamTable[team] = nil
		end
		teamTable = {}
		teamColorTable = {}
	end

	local function getBoardTypeInfo()
		local isTeam  = (currentBoardType == "TeamScore" or currentBoardType == "TeamList")
		local isScore = (currentBoardType == "TeamScore" or currentBoardType == "PlayerScore")
		return isTeam, isScore
	end


	local function recomputeTeamScore(team, column)
		if not team or team == "Neutral" then
			return
		end
		
		local function recomputeScoreHelper(statChangers)
			if statChangers and column <= #statChangers then
				local sum = 0
				for i, p in ipairs(teamTable[team].Players) do
					if playerTable[p].StatValues and column <= #playerTable[p].StatValues then
						sum = sum + playerTable[p].StatValues[column].Value
					end
				end
				statChangers[column](sum)
			end
		end

		recomputeScoreHelper(teamTable[team].StatChangersSmall)
		recomputeScoreHelper(teamTable[team].StatChangersBig)
	end
	local function recomputeCompleteTeamScore(team)
		local col = 1
		while col <= currentStatCount do
			recomputeTeamScore(team, col)
			col = col + 1
		end
	end
	removeFromTeam = function(player)
		if playerTable[player].CurrentTeam ~= nil and teamTable[playerTable[player].CurrentTeam] ~= nil then
			ArrayRemove(teamTable[playerTable[player].CurrentTeam].Players, player)
			recomputeCompleteTeamScore(playerTable[player].CurrentTeam)
			playerTable[player].CurrentTeam = nil
		end
	end

	local function assignToTeam(player)
		local isTeam, isScore = getBoardTypeInfo()

		if isTeam then
			local newTeam = nil

			if player.Neutral or teamColorTable[player.TeamColor.Name] == nil then
				newTeam = "Neutral"
			else
				newTeam = teamColorTable[player.TeamColor.Name] 
			end			

			if playerTable[player].CurrentTeam == newTeam then
				return
			end

			removeFromTeam(player)

			playerTable[player].CurrentTeam = newTeam
			if teamTable[newTeam] then table.insert(teamTable[newTeam].Players, player) end
	
			if newTeam == "Neutral" then
				updatePlayerNameColor(player, nil)
			else
				updatePlayerNameColor(player, player.TeamColor)
			end
			
			recomputeCompleteTeamScore(newTeam)
			
			--Relayout
			if sortPlayerListsFunction then
				sortPlayerListsFunction()
			end
		end
	end
	
	local function buildTeamObject(team, numStatColumns, suffix)
		local isTeam, isScore = getBoardTypeInfo()
		local teamObject = createTeamName(team.Name, team.TeamColor)
		if not teamTable[team] then
			teamTable[team] = {} 
		end
		teamTable[team]["NameObject" .. suffix] = teamObject
		if isScore then
			local statObject
			local textChangers
			teamObject, statObject, textChangers = createStatColumns(teamObject, numStatColumns, true, suffix == "Big")
			teamTable[team]["StatObject" .. suffix] = statObject
			teamTable[team]["StatChangers" .. suffix] = textChangers
		end
		teamTable[team]["MainObject" .. suffix] = teamObject
		if not teamTable[team].Players then
			teamTable[team].Players = {}
		end
		return teamObject
	end
	
	local currentContextMenuPlayer = nil
	local function updatePlayerContextMenu(player)
		currentContextMenuPlayer = player
		local elementHeight = 20
		local function highlight(button)
			button.TextColor3 = Color3.new(0,0,0)
			button.BackgroundColor3 = Color3.new(0.8,0.8,0.8)
		end
		local function clearHighlight(button)
			button.TextColor3 = Color3.new(1,1,1)
			button.BackgroundColor3 = Color3.new(0,0,0)
		end
		if playerContextMenu == nil then
			playerContextMenu = Instance.new("Frame")
			playerContextMenu.Name = "PlayerListContextMenu"
			playerContextMenu.BackgroundTransparency = 1
			playerContextMenu.Visible = false
		
			local playerContextMenuButton = Instance.new("TextButton")
			playerContextMenuButton.Name = "PlayerListContextMenuButton"
			playerContextMenuButton.Text = ""
			playerContextMenuButton.Style = Enum.ButtonStyle.RobloxButtonDefault
			playerContextMenuButton.ZIndex = 4
			playerContextMenuButton.Size = UDim2.new(1, 0, 1, -20)
			playerContextMenuButton.Visible = true
			playerContextMenuButton.Parent = playerContextMenu

			for i, contextElement in ipairs(contextMenuElements) do
				local element = contextElement
				if element.Type == "Button" then
					local button = Instance.new("TextButton")	
					button.Name = "ContextButton" .. i
					button.BackgroundColor3 = Color3.new(0,0,0)
					button.BorderSizePixel = 0
					button.TextXAlignment = Enum.TextXAlignment.Left
					button.Text = " " .. contextElement.Text
					button.Font = Enum.Font.Arial
					button.FontSize = Enum.FontSize.Size14
					button.Size = UDim2.new(1, 8, 0, elementHeight)
					button.TextColor3 = Color3.new(1,1,1)
					button.ZIndex = 4
					button.Parent = playerContextMenuButton
					button.MouseButton1Click:connect(function()
						if button.Active then
							local success, result = pcall(function() element.DoIt(currentContextMenuPlayer) end)
							playerContextMenu.Visible = false
						end
					end)
					
					button.MouseEnter:connect(function()
						if button.Active then
							highlight(button)
						end
					end)
					button.MouseLeave:connect(function()
						if button.Active then
							clearHighlight(button)
						end
					end)
					
					contextElement.Button = button
					contextElement.Element = button
				elseif element.Type == "Label" then
					local frame = Instance.new("Frame")
					frame.Name = "ContextLabel" .. i
					frame.BackgroundTransparency = 1
					frame.Size = UDim2.new(1, 8, 0, elementHeight)
	
					local label = Instance.new("TextLabel")	
					label.Name = "Text1"
					label.BackgroundTransparency = 1
					label.BackgroundColor3 = Color3.new(1,1,1)
					label.BorderSizePixel = 0
					label.TextXAlignment = Enum.TextXAlignment.Left
					label.Font = Enum.Font.ArialBold
					label.FontSize = Enum.FontSize.Size14
					label.Position = UDim2.new(0.0, 0, 0, 0)
					label.Size = UDim2.new(0.5, 0, 1, 0)
					label.TextColor3 = Color3.new(1,1,1)
					label.ZIndex = 4
					label.Parent = frame
					element.Label1 = label
				
					if element.GetText2 then
						label = Instance.new("TextLabel")	
						label.Name = "Text2"
						label.BackgroundTransparency = 1
						label.BackgroundColor3 = Color3.new(1,1,1)
						label.BorderSizePixel = 0
						label.TextXAlignment = Enum.TextXAlignment.Right
						label.Font = Enum.Font.Arial
						label.FontSize = Enum.FontSize.Size14
						label.Position = UDim2.new(0.5, 0, 0, 0)
						label.Size = UDim2.new(0.5, 0, 1, 0)
						label.TextColor3 = Color3.new(1,1,1)
						label.ZIndex = 4
						label.Parent = frame
						element.Label2 = label
					end
					frame.Parent = playerContextMenuButton
					element.Label = frame
					element.Element =  frame
				end
			end

			playerContextMenu.ZIndex = 4
			playerContextMenu.MouseLeave:connect(function() playerContextMenu.Visible = false end)
			robloxLock(playerContextMenu)
			playerContextMenu.Parent = game:GetService("CoreGui").RobloxGui
			
		end
		
		local elementPos = 0
		for i, contextElement in ipairs(contextMenuElements) do
			local isVisible = false

			if contextElement.IsVisible then
				local success, visible = pcall(function() return contextElement.IsVisible(currentContextMenuPlayer) end)
				if success then 
					isVisible = visible
				else
					print("Error in IsVisible call: " .. visible)
				end
			end

			if contextElement.Type == "Button" then
				contextElement.Button.Visible = isVisible
				if contextElement.Button.Visible then
					isVisible = true
					clearHighlight(contextElement.Button)
					if contextElement.IsActive then
						local success, active = pcall(function() return contextElement.IsActive(currentContextMenuPlayer) end)
						if success then 
							contextElement.Button.Active = active
						else
							print("Error in IsActive call: " .. active)
						end
					end
					if contextElement.Button.Active then
						contextElement.Button.TextColor3 = Color3.new(1,1,1)
					else
						contextElement.Button.TextColor3 = Color3.new(0.7,0.7,0.7)
					end
				end
			elseif contextElement.Type == "Label" then
				contextElement.Label.Visible = isVisible
				if contextElement.Label.Visible then
					local success, text = pcall(function() return contextElement.GetText1(currentContextMenuPlayer) end)
					if success then
						contextElement.Label1.Text = " " .. text
					else
						print("Error in GetText1 call: " .. text)
					end

					if contextElement.GetText2 then
						local success, text = pcall(function() return contextElement.GetText2(currentContextMenuPlayer) end)
						if success then
							contextElement.Label2.Text = " " .. text
						else
							print("Error in GetText2 call: " .. text)
						end
					end
				end
			end
			if isVisible then
				contextElement.Element.Position = UDim2.new(0,-4, 0, elementPos * elementHeight - 4)
				elementPos = elementPos + 1
			end
		end
		playerContextMenu.Size = UDim2.new(0, 150, 0, elementPos*elementHeight + 13 + 20)
	end
	local function showPlayerMenu(player, x, y)
		updatePlayerContextMenu(player)
		x = x - (playerContextMenu.AbsoluteSize.X/2)
		if x + playerContextMenu.AbsoluteSize.X >= game:GetService("CoreGui").RobloxGui.AbsoluteSize.X then
			x = game:GetService("CoreGui").RobloxGui.AbsoluteSize.X - playerContextMenu.AbsoluteSize.X
		end
		playerContextMenu.Visible = true
		playerContextMenu.Position = UDim2.new(0, x, 0, y-playerContextMenu.AbsoluteSize.Y)
	end

	local function buildPlayerObject(player, numStatColumns, suffix)
		if not player then return nil end
		
		local isTeam, isScore = getBoardTypeInfo()

		local playerObject = nil
		local changePlayerNameFunction = nil
		local currentColor = nil
		if isTeam and not player.Neutral then
			currentColor = player.TeamColor.Color
		else
			currentColor = Color3.new(1,1,1)
		end
			playerObject, changePlayerNameFunction = createPlayerName(player.Name, player.MembershipType, currentColor, getFriendStatus(player))
		
		if not playerTable[player] then
			playerTable[player] = {}
		end
		if not playerTable[player].Connections then
			playerTable[player].Connections = {}
		end
		if not playerTable[player].CurrentTeam then
			playerTable[player].CurrentTeam = nil
		end
		playerTable[player]["NameObject" .. suffix] = playerObject
		playerTable[player]["ChangeName" .. suffix] = changePlayerNameFunction

		if isScore then
			local statObject = nil
			local textChangers = nil
			playerObject, statObject, textChangers = createStatColumns(playerObject, numStatColumns, false, suffix == "Big")
			playerTable[player]["StatObject" .. suffix]= statObject
			playerTable[player]["StatChangers" .. suffix] = textChangers
			
			local statValues, leaderstats = getStatValuesForPlayer(player)
			if not statValues or #statValues < numStatColumns then
				if not playerTable[player].LeaderStatConnections then
					playerTable[player].LeaderStatConnections = {}
				end
				--Setup a listener to see when this data gets filled in
				if not leaderstats then
					--We don't even have a leaderstats child, wait for one
					table.insert(playerTable[player].LeaderStatConnections, 
						player.ChildAdded:connect(
							function(child)
								if child.Name == "leaderstats" then
									--Connections will be torn down
									recreatePlayerFunction(player)
								else
									table.insert(playerTable[player].LeaderStatConnections, 
										child.Changed:connect(
											function(prop)
												if prop == "Name" and child.Name == "leaderstats" then
													--Connections will be torn down
													recreatePlayerFunction(player)
												end
											end))
								end
							end))
				else
					--We have a leaderstats, but not enough children, recreate if we get them
					table.insert(playerTable[player].LeaderStatConnections, 
						leaderstats.ChildAdded:connect(
							function(child)
								--TODO only look for IntValue
								recreatePlayerFunction(player)
							end)
						)
					table.insert(playerTable[player].LeaderStatConnections, 
						leaderstats.AncestryChanged:connect(
							function(child)
								--We got deleted, try again
								recreatePlayerFunction(player)
							end)
						)
				end
			end
			if statValues then
				if not playerTable[player].StatValues then
					playerTable[player].StatValues = {}
				end
				local pos = 1
				while pos <= numStatColumns and pos <= #statValues do
					local currentColumn = pos
					local statValue = statValues[pos]
					local statChanger = textChangers[pos]

					local updateStat = function(val)
						statChanger(val)
						if playerTable[player] ~= nil then recomputeTeamScore(playerTable[player].CurrentTeam, currentColumn) end
					end
					if pos > #playerTable[player].StatValues then
						table.insert(playerTable[player].StatValues, statValue)
					end

					if type(statValue) ~= "number" and statValue["Changed"] then
						table.insert(playerTable[player].Connections,
							statValue.Changed:connect(updateStat)
						)
					end
					
					table.insert(playerTable[player].Connections,
						statValue.AncestryChanged:connect(
						function()
							recreatePlayerFunction(player)
						end)
					)
					updateStat(statValue.Value)
					pos = pos + 1
				end
			end
		end
		
		if supportFriends and player ~= game.Players.LocalPlayer and player.userId > 0 and  game.Players.LocalPlayer.userId > 0 then
			local button = Instance.new("TextButton")
			button.Name = playerObject.Name .. "Button"
			button.Text = ""
			button.Active = false
			button.Size = playerObject.Size
			button.Position = playerObject.Position
			button.BackgroundColor3 = playerObject.BackgroundColor3
			
			local secondButton = Instance.new("TextButton")
			secondButton.Name = playerObject.Name .. "RealButton"
			secondButton.Text = ""
			secondButton.BackgroundTransparency = 1
			secondButton.BackgroundColor3 = playerObject.BackgroundColor3
			local theNameLabel = playerObject:findFirstChild("NameLabel",true)
			if theNameLabel then
				theNameLabel.TextColor3 = Color3.new(1,1,1)
				secondButton.Parent = theNameLabel
			end
			secondButton.Parent.BackgroundTransparency = 1
			secondButton.Parent.Visible = true
			secondButton.ZIndex = 2
			secondButton.Size = UDim2.new(1,0,1,0)

			local previousTransparency = nil
			table.insert(playerTable[player].Connections,
				secondButton.MouseEnter:connect(
					function()
						if previousTransparency == nil then
							previousTransparency = secondButton.BackgroundTransparency
						end

						if lightBackground then
							secondButton.Parent.BackgroundTransparency = 0
						else
							secondButton.Parent.BackgroundTransparency = 1
						end
					end))
			table.insert(playerTable[player].Connections,
				secondButton.MouseLeave:connect(
					function()
						if previousTransparency ~= nil then					
							previousTransparency = nil
						end
						secondButton.Parent.BackgroundTransparency = 1
					end))
			
			local mouseDownX, mouseDownY
			table.insert(playerTable[player].Connections,
				secondButton.MouseButton1Down:connect(function(x,y) 
					mouseDownX = x
					mouseDownY = y
				end))
			table.insert(playerTable[player].Connections,
				secondButton.MouseButton1Click:connect(function() 
					showPlayerMenu(player, mouseDownX, secondButton.AbsolutePosition.Y + secondButton.AbsoluteSize.Y )
				end))
			playerObject.BackgroundTransparency = 1
			playerObject.Size = UDim2.new(1,0,1,0)
			playerObject.Position = UDim2.new(0,0,0,0)
			playerObject.Parent = button
			
			playerTable[player]["MainObject" .. suffix] = button
			
			playerObject = button
		else
			playerTable[player]["MainObject" .. suffix] = playerObject
			
			if player == game.Players.LocalPlayer and supportFriends then
				table.insert(playerTable[player].Connections,
					player.FriendStatusChanged:connect(
					function(otherPlayer, friendStatus)
						if playerTable[otherPlayer] then
							updatePlayerFriendStatus(playerTable[otherPlayer]["NameObject" .. suffix], friendStatus)
						end
					end)
				)
			end
		end
		table.insert(playerTable[player].Connections,
			player.Changed:connect(
				function(prop)
					if prop == "MembershipType" then
						updatePlayerName(playerTable[player]["NameObject" .. suffix], player.MembershipType, currentColor)
					elseif prop == "Name" then
						playerTable[player]["ChangeName" .. suffix](player.Name)
					elseif prop == "Neutral" or prop == "TeamColor" then
						assignToTeam(player)
					end
				end)
			)
		return playerObject
	end

	local function orderScrollList(scrollOrder, objectName, scrollFrame)
		local pos = 0
		local order = {}
		local isTeam, isScore = getBoardTypeInfo()
		for i, obj in ipairs(scrollOrder) do
			order[obj] = 0
		end

		if isTeam then
			local teams = getTeams()
			for i, team in ipairs(teams) do
				if teamTable[team][objectName] then order[teamTable[team][objectName]] = pos end
				pos = pos + 1
				for i, player in ipairs(teamTable[team].Players) do
					if playerTable[player] then
						if playerTable[player][objectName] ~= nil then order[playerTable[player][objectName]] = pos end
						pos = pos + 1
					end
				end
			end
			
			if #teamTable["Neutral"].Players > 0 then
				teamTable["Neutral"][objectName].Parent = scrollFrame
				order[teamTable["Neutral"][objectName]] = pos
				pos = pos + 1
				for i, player in ipairs(teamTable["Neutral"].Players) do
					if playerTable[player][objectName] ~= nil then order[playerTable[player][objectName]] = pos end
					pos = pos + 1
				end
			else
				teamTable["Neutral"][objectName].Parent = nil
			end
		else
			local players = getPlayers()
			for i, player in ipairs(players) do
				if playerTable[player] and playerTable[player][objectName] ~= nil then order[playerTable[player][objectName]] = pos end
				pos = pos + 1
			end	
		end

		table.sort(scrollOrder, 
			function(a,b) 
				return order[a] < order[b] 
			end)
	end
	
	local function createPlayerListBasics(frame, isBig)
		local headerFrame = Instance.new("Frame")
		headerFrame.Name = "Header"
		headerFrame.BackgroundTransparency = 1
		headerFrame.Size = UDim2.new(1,-13,0,26)
		headerFrame.Position = UDim2.new(0,0,0,0)
		headerFrame.Parent = frame

		local lowerPaneFrame = Instance.new("Frame")
		lowerPaneFrame.Name = "ScrollingArea"
		lowerPaneFrame.BackgroundTransparency = 1
		lowerPaneFrame.Size = UDim2.new(1,-3,1,-26)
		if not isBig then lowerPaneFrame.Size = UDim2.new(1,-3,1,-30) end
		lowerPaneFrame.Position = UDim2.new(0,0,0,26)
		lowerPaneFrame.Parent = frame

		local scrollOrder = {}
		local scrollFrame, scrollUp, scrollDown, recalculateScroll = RbxGui.CreateScrollingFrame(scrollOrder)

		local scrollBar = Instance.new("Frame")
		scrollBar.Name = "ScrollBar"
		scrollBar.BackgroundTransparency = 0.9
		scrollBar.BackgroundColor3 = Color3.new(1,1,1)
		scrollBar.BorderSizePixel = 0
		scrollBar.Size = UDim2.new(0, 17, 1, -36)
		if isBig then scrollBar.Size = UDim2.new(0, 17, 1, -61) end
		scrollBar.Parent = lowerPaneFrame

		scrollFrame.Parent = lowerPaneFrame
		scrollUp.Parent = lowerPaneFrame
		scrollDown.Parent = lowerPaneFrame

		if isBig then
			scrollFrame.Position = UDim2.new(0,0,0,0)
			scrollUp.Position = UDim2.new(1,-41,0,5)
			scrollDown.Position = UDim2.new(1,-41,1,-35)
			scrollBar.Position = UDim2.new(1, -41, 0, 24)

			scrollFrame.Size = UDim2.new(1,-48,1,-16)
			headerFrame.Size = UDim2.new(1,-20,0,32)
			
		else
			scrollBar.Position = UDim2.new(1, -15, 0, 14)
			scrollBar.Size = UDim2.new(0,17,1,-36)
			scrollFrame.Position = UDim2.new(0,1,0,0)
			scrollUp.Position = UDim2.new(1,-15,0,-5)
			scrollDown.Position = UDim2.new(1,-15,1,-20)
			
			lowerPaneFrame.Position = UDim2.new(0,0,0,30)

			local toggleScrollBar = function(visible)
				if visible then
					scrollFrame.Size = UDim2.new(1,-16,1,0)
					headerFrame.Size = UDim2.new(1,-16,0,smallWindowHeaderYSize)
				else
					scrollFrame.Size = UDim2.new(1,0,1,0)
					headerFrame.Size = UDim2.new(1,5,0,smallWindowHeaderYSize)
				end
				scrollUp.Visible = visible
				scrollDown.Visible = visible
				scrollBar.Visible = visible
			end
			scrollUp.Changed:connect(function(prop) 
				if prop == "Active" then
					toggleScrollBar(scrollUp.Active or scrollDown.Active)
				end
			end)

			scrollDown.Changed:connect(function(prop) 
				if prop == "Active" then
					toggleScrollBar(scrollUp.Active or scrollDown.Active)
				end
			end)

			toggleScrollBar(scrollUp.Active or scrollDown.Active)
		end
		return headerFrame, scrollFrame, recalculateScroll, scrollOrder
	end
			
	createBoardsFunction = function (boardType, numStatColumns)
		local smallFrame = Instance.new("Frame")
		smallFrame.Name = "SmallPlayerlist"
		smallFrame.Position = smallWindowPosition
		smallFrame.Active = false
		smallFrame.Size = smallWindowSize
		smallFrame.BackgroundColor3 = Color3.new(0,0,0)
		smallFrame.BackgroundTransparency = 0.7
		smallFrame.BorderSizePixel = 0

		local bigFrame = Instance.new("Frame")
		bigFrame.Name = "BigPlayerlist"
		bigFrame.Size = bigWindowSize
		bigFrame.Position = bigWindowPosition
		bigFrame.BackgroundColor3 = Color3.new(0,0,0)
		bigFrame.BackgroundTransparency = 0.7
		bigFrame.BorderSizePixel = 0
		bigFrame.Visible = false		
		
		local bigFrameWrapper = Instance.new("Frame")
		bigFrameWrapper.Name = "Expander"
		bigFrameWrapper.Size = UDim2.new(1,21,1,16)
		bigFrameWrapper.Position = UDim2.new(0, 0, 0,0)
		bigFrameWrapper.BackgroundTransparency = 1
		bigFrameWrapper.Parent = bigFrame

		local smallHeaderFrame, scrollFrameSmall, recalculateScrollSmall, scrollOrderSmall = createPlayerListBasics(smallFrame, false)
		local bigHeaderFrame, scrollFrameBig, recalculateScrollBig, scrollOrderBig = createPlayerListBasics(bigFrameWrapper, true)
		
		local playerListButton = Instance.new("ImageButton")
		playerListButton.Name = "GoBigButton"
		playerListButton.BackgroundTransparency = 1
		playerListButton.Image = "rbxasset://textures/ui/playerlist_small_maximize.png"
		playerListButton.Size = UDim2.new(0.0, 35, 0, 29)
		playerListButton.Position = UDim2.new(0, 0, 0, 0)
		playerListButton.MouseButton1Click:connect(
			function()
				toggleBigWindow()
			end)
		playerListButton.Parent = smallHeaderFrame

		playerListButton = Instance.new("ImageButton")
		playerListButton.Name = "CloseButton"
		playerListButton.BackgroundTransparency = 1
		playerListButton.Image = "rbxasset://textures/ui/playerlist_small_hide.png"
		playerListButton.Size = UDim2.new(0.0, 38, 0, 29)
		playerListButton.Position = UDim2.new(0, 35, 0, 0)
		playerListButton.MouseButton1Click:connect(
			function()
				transitionWindowsFunction("None")
			end)
		playerListButton.Parent = smallHeaderFrame

		playerListButton = Instance.new("ImageButton")
		playerListButton.Name = "CloseButton"
		playerListButton.Image = "rbxasset://textures/ui/playerlist_big_hide.png"
		playerListButton.BackgroundTransparency = 1
		playerListButton.Size = UDim2.new(0.0, 29, 0, 29)
		playerListButton.Position = UDim2.new(1, -30, 0.5, -15)
		playerListButton.MouseButton1Click:connect(
			function()
				toggleBigWindow()
			end)
		playerListButton.Parent = bigHeaderFrame

		local placeName = Instance.new("TextLabel")
		placeName.Name = "PlaceName"
		placeName.Text = " Player List"
		placeName.FontSize = Enum.FontSize.Size24
		placeName.TextXAlignment = Enum.TextXAlignment.Left
		placeName.Font = Enum.Font.ArialBold
		placeName.BackgroundTransparency = 1
		placeName.TextColor3 = Color3.new(1,1,1)
		placeName.Size = UDim2.new(0.5, 0, 1, 0)
		placeName.Position = UDim2.new(0, 0, 0.0, 0)
		placeName = RbxGui.AutoTruncateTextObject(placeName)
		placeName.Parent = bigHeaderFrame
		

		currentBoardType = boardType
		currentStatCount = numStatColumns
		local isTeam, isScore = getBoardTypeInfo()
		local players = getPlayers()
		
		if isScore then
			local statColumns = getStatColumns(players)
			numStatColumns = #statColumns
			if numStatColumns > 3 then
				numStatColumns = 3
			end
			createStatHeaders(statColumns, numStatColumns, false).Parent = smallHeaderFrame
			createStatHeaders(statColumns, currentStatCount, true).Parent = bigHeaderFrame
		end

		--Clean up all old stuff
		resetPlayerTable()

		for i, player in ipairs(players) do
			local playerObject = buildPlayerObject(player, numStatColumns, "Small")
			table.insert(scrollOrderSmall, playerObject)
			playerObject.Parent = scrollFrameSmall

			playerObject = buildPlayerObject(player, currentStatCount, "Big")
			table.insert(scrollOrderBig, playerObject)
			playerObject.Parent = scrollFrameBig
		end

		--Clean up old stuff
		resetTeamTable()

		local teamStatObjects = {}
		if isTeam then
			local teams = getTeams()
			local i = #teams
			while i >= 1 do
				--We go backwards so the "first" team color gets the team
				local team = teams[i]
				teamColorTable[team.TeamColor.Name] = team
				i = i - 1
			end 

			--Adding/Removing a Team causes a full invalidation of the board
			for i, team in ipairs(teams) do
				local teamObject = buildTeamObject(team, numStatColumns, "Small")
				table.insert(scrollOrderSmall, teamObject)
				teamObject.Parent = scrollFrameSmall

				teamObject = buildTeamObject(team, currentStatCount, "Big")
				table.insert(scrollOrderBig, teamObject)
				teamObject.Parent = scrollFrameBig
			end

			teamTable["Neutral"] = {}
			teamTable["Neutral"].Players = {}

			local neutralTeamObject = createTeamName("Neutral", BrickColor.palette(8))
			teamTable["Neutral"].NameObjectSmall = neutralTeamObject
			teamTable["Neutral"].StatObjectSmall = nil
			teamTable["Neutral"].MainObjectSmall = neutralTeamObject
			table.insert(scrollOrderSmall, neutralTeamObject)

			neutralTeamObject = createTeamName("Neutral", BrickColor.palette(8))
			teamTable["Neutral"].NameObjectBig = neutralTeamObject
			teamTable["Neutral"].StatObjectBig = nil
			teamTable["Neutral"].MainObjectBig = neutralTeamObject
			table.insert(scrollOrderBig, neutralTeamObject)

			local neutralPlayers = {}
			for i, player in ipairs(players) do
				assignToTeam(player)
			end
		end

		removePlayerFunction = function(player)
			if playerTable[player] then
				clearTableEntry(player, playerTable[player])
				
				ArrayRemove(scrollOrderSmall, playerTable[player].MainObjectSmall)
				ArrayRemove(scrollOrderBig, playerTable[player].MainObjectBig)
	
				playerTable[player] = nil
				recalculateSmallPlayerListSize(smallFrame)
			end
		end
		recreatePlayerFunction = function(player)
			removePlayerFunction(player)

			local playerObject = buildPlayerObject(player, numStatColumns, "Small")
			table.insert(scrollOrderSmall, playerObject)
			robloxLock(playerObject)
			playerObject.Parent = scrollFrameSmall

			playerObject = buildPlayerObject(player, currentStatCount, "Big")
			table.insert(scrollOrderBig, playerObject)
			robloxLock(playerObject)
			playerObject.Parent = scrollFrameBig
			
			local isTeam, isScore = getBoardTypeInfo()
			if isTeam then
				assignToTeam(player)
			end

			sortPlayerListsFunction()
			recalculateSmallPlayerListSize(smallFrame)
		end
		
		if screenResizeCon then screenResizeCon:disconnect() end
		screenResizeCon = screen.Changed:connect(
			function(prop)
				if prop == "AbsoluteSize" then
					wait()
					recalculateSmallPlayerListSize(smallFrame)
				end
			end)

		sortPlayerListsFunction = function()
			orderScrollList(scrollOrderSmall, "MainObjectSmall", scrollFrameSmall)
			recalculateScrollSmall()
			createAlternatingRows(scrollOrderSmall)

			orderScrollList(scrollOrderBig, "MainObjectBig", scrollFrameBig)
			recalculateScrollBig()
			createAlternatingRows(scrollOrderBig)
		end

		sortPlayerListsFunction()

		robloxLock(smallFrame)
		robloxLock(bigFrame)
		return smallFrame, bigFrame
	end

	--Teams changing invalidates the whole board	
	local function teamsChanged()
		if debounceTeamsChanged then 
			return 
		end

		debounceTeamsChanged = true
		wait()
		rebuildBoard(game:GetService("CoreGui").RobloxGui, determineBoardType())
		debounceTeamsChanged = false
	end

	
	local checkIfBoardChanged = function()
		local newBoardType, numStats = determineBoardType()
		if newBoardType ~= currentBoardType or numStats ~= currentStatCount then
			rebuildBoard(game:GetService("CoreGui").RobloxGui, newBoardType, numStats)
		end
	end

	local function buildPlayerList()
		waitForChild(game, "Players")
		waitForProperty(game.Players, "LocalPlayer")

		local playerListEnabled = testPlayerListPlaces[game.PlaceId] or enablePlayerListGlobally
		if localTesting and (game.PlaceId == 0) or (game.PlaceId == -1) then
			playerListEnabled = true
		end
		if not playerListEnabled then
			--No playerlist
			return
		end
		
		supportFriends = testFriendingPlaces[game.PlaceId] or enableFriendingGlobally
		if localTesting and (game.PlaceId == 0) or (game.PlaceId == -1) then
			supportFriends = true
		end
		
		local teams = game:GetService("Teams")
		if teams then
			local teamConnections = {}

			teams.ChildAdded:connect(
				function(child)
					if child:IsA("Team") then
						teamsChanged()
						teamConnections[child] = child.Changed:connect(
							function(prop)
								if prop == "TeamColor" or prop == "Name" then
									--Rebuild when things change
									teamsChanged()
								end
							end)
					end
				end)
			teams.ChildRemoved:connect(
				function(child)
					if child:IsA("Team") then
						if teamConnections[child] then
							teamConnections[child]:disconnect()
							teamConnections[child] = nil
						end
						teamsChanged()
					end
				end)
		end

		game.Players.ChildAdded:connect(
			function(player)
				if player:IsA("Player") then
					addPlayerFunction(player)
				end
			end)

		game.Players.ChildRemoved:connect(
			function(player)
				if player:IsA("Player") then
					if removePlayerFunction then
						removePlayerFunction(player)
					end
				end
			end)

		rebuildBoard(screen, determineBoardType())
		game.GuiService.ShowLegacyPlayerList = false

		game.GuiService:AddKey("\t")
		local lastTime = nil
		game.GuiService.KeyPressed:connect(
		function(key)
			if key == "\t" then
				local modalCheck, isModal = pcall(function() return game.GuiService.IsModalDialog end)
				if modalCheck == false or (modalCheck and isModal == false) then
					local currentTime = time()
					if lastTime == nil or currentTime - lastTime > 0.4 then
						lastTime = currentTime
						toggleBigWindow()
					end
				end
			end
		end)

		delay(0,
			function()
				while true  do
					wait(5)
					checkIfBoardChanged()
				end
			end)
	end
	
	if game.CoreGui.Version >= 2 then
		buildPlayerList()
	end
end 

end)


--build our gui

delay(0, function()

local popupFrame = Instance.new("Frame")
popupFrame.Position = UDim2.new(0.5,-165,0.5,-175)
popupFrame.Size = UDim2.new(0,330,0,350)
popupFrame.Style = Enum.FrameStyle.RobloxRound
popupFrame.ZIndex = 4
popupFrame.Name = "Popup"
popupFrame.Visible = false
popupFrame.Parent = game:GetService("CoreGui").RobloxGui

local darken = popupFrame:clone()
darken.Size = UDim2.new(1,16,1,16)
darken.Position = UDim2.new(0,-8,0,-8)
darken.Name = "Darken"
darken.ZIndex = 1
darken.Parent = popupFrame

local acceptButton = Instance.new("TextButton")
acceptButton.Position = UDim2.new(0,20,0,270)
acceptButton.Size = UDim2.new(0,100,0,50)
acceptButton.Font = Enum.Font.ArialBold
acceptButton.FontSize = Enum.FontSize.Size24
acceptButton.Style = Enum.ButtonStyle.RobloxButton
acceptButton.TextColor3 = Color3.new(248/255,248/255,248/255)
acceptButton.Text = "Yes"
acceptButton.ZIndex = 5
acceptButton.Name = "AcceptButton"
acceptButton.Parent = popupFrame

local declineButton = acceptButton:clone()
declineButton.Position = UDim2.new(1,-120,0,270)
declineButton.Text = "No"
declineButton.Name = "DeclineButton"
declineButton.Parent = popupFrame

local popupImage = Instance.new("ImageLabel")
popupImage.BackgroundTransparency = 1
popupImage.Position = UDim2.new(0.5,-140,0,0)
popupImage.Size = UDim2.new(0,280,0,280)
popupImage.ZIndex = 3
popupImage.Name = "PopupImage"
popupImage.Parent = popupFrame

local backing = Instance.new("ImageLabel")
backing.BackgroundTransparency = 1
backing.Size = UDim2.new(1,0,1,0)
backing.Image = "rbxasset://textures/ui/Backing.png"
backing.Name = "Backing"
backing.ZIndex = 2
backing.Parent = popupImage

local popupText = Instance.new("TextLabel")
popupText.Name = "PopupText"
popupText.Size = UDim2.new(1,0,0.8,0)
popupText.Font = Enum.Font.ArialBold
popupText.FontSize = Enum.FontSize.Size36
popupText.BackgroundTransparency = 1
popupText.Text = "Hello I'm a popup"
popupText.TextColor3 = Color3.new(248/255,248/255,248/255)
popupText.TextWrap = true
popupText.ZIndex = 5
popupText.Parent = popupFrame

end)

-- this script is responsible for keeping the gui proportions under control

delay(0, function()

local screen = game:GetService("CoreGui").RobloxGui

local BottomLeftControl
local BottomRightControl
local TopLeftControl
local BuildTools

local controlFrame = screen:FindFirstChild("ControlFrame")
local loadoutPadding = 43
local currentLoadout

BottomLeftControl = controlFrame:FindFirstChild("BottomLeftControl")
BottomRightControl = controlFrame:FindFirstChild("BottomRightControl")
TopLeftControl = controlFrame:FindFirstChild("TopLeftControl")
currentLoadout = screen:FindFirstChild("CurrentLoadout")
BuildTools = controlFrame:FindFirstChild("BuildTools")

function makeYRelative()

	BottomLeftControl.SizeConstraint = 2
	BottomRightControl.SizeConstraint = 2
	if TopLeftControl then TopLeftControl.SizeConstraint = 2 end
	if currentLoadout then currentLoadout.SizeConstraint = 2 end
	if BuildTools then BuildTools.Frame.SizeConstraint = 2 end
	
	BottomLeftControl.Position = UDim2.new(0,0,1,-BottomLeftControl.AbsoluteSize.Y)
	BottomRightControl.Position = UDim2.new(1,-BottomRightControl.AbsoluteSize.X,1,-BottomRightControl.AbsoluteSize.Y)
	
end



function makeXRelative()

	BottomLeftControl.SizeConstraint = 1
	BottomRightControl.SizeConstraint = 1
	if TopLeftControl then TopLeftControl.SizeConstraint = 1 end
	if currentLoadout then currentLoadout.SizeConstraint = 1 end
	if BuildTools then BuildTools.Frame.SizeConstraint = 1 end

	BottomLeftControl.Position = UDim2.new(0,0,1,-BottomLeftControl.AbsoluteSize.Y)
	BottomRightControl.Position = UDim2.new(1,-BottomRightControl.AbsoluteSize.X,1,-BottomRightControl.AbsoluteSize.Y)

end

local function resize()
	if screen.AbsoluteSize.x > screen.AbsoluteSize.y then
		makeYRelative()
	else
		makeXRelative()
	end
	if currentLoadout then
		currentLoadout.Position =
			UDim2.new(0,screen.AbsoluteSize.X/2 -currentLoadout.AbsoluteSize.X/2,currentLoadout.Position.Y.Scale,-currentLoadout.AbsoluteSize.Y - loadoutPadding)
	end
end
screen.Changed:connect(function(property)

	if property == "AbsoluteSize" then
		wait()
		resize()
	end

end)

wait()
resize()

end)

-- RBXGUI START --
local RbxGuiLib = {}

local function ScopedConnect(parentInstance, instance, event, signalFunc, syncFunc, removeFunc)
	local eventConnection = nil

	--Connection on parentInstance is scoped by parentInstance (when destroyed, it goes away)
	local tryConnect = function()
		if game:IsAncestorOf(parentInstance) then
			--Entering the world, make sure we are connected/synced
			if not eventConnection then
				eventConnection = instance[event]:connect(signalFunc)
				if syncFunc then syncFunc() end
			end
		else
			--Probably leaving the world, so disconnect for now
			if eventConnection then
				eventConnection:disconnect()
				if removeFunc then removeFunc() end
			end
		end
	end

	--Hook it up to ancestryChanged signal
	local connection = parentInstance.AncestryChanged:connect(tryConnect)
	
	--Now connect us if we're already in the world
	tryConnect()
	
	return connection
end

local function CreateButtons(frame, buttons, yPos, ySize)
	local buttonNum = 1
	local buttonObjs = {}
	for i, obj in ipairs(buttons) do 
		local button = Instance.new("TextButton")
		button.Name = "Button" .. buttonNum
		button.Font = Enum.Font.Arial
		button.FontSize = Enum.FontSize.Size18
		button.AutoButtonColor = true
		button.Style = Enum.ButtonStyle.RobloxButtonDefault 
		button.Text = obj.Text
		button.TextColor3 = Color3.new(1,1,1)
		button.MouseButton1Click:connect(obj.Function)
		button.Parent = frame
		buttonObjs[buttonNum] = button

		buttonNum = buttonNum + 1
	end
	local numButtons = buttonNum-1

	if numButtons == 1 then
		frame.Button1.Position = UDim2.new(0.35, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.4,0,ySize.Scale, ySize.Offset)
	elseif numButtons == 2 then
		frame.Button1.Position = UDim2.new(0.1, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.8/3,0, ySize.Scale, ySize.Offset)

		frame.Button2.Position = UDim2.new(0.55, 0, yPos.Scale, yPos.Offset)
		frame.Button2.Size = UDim2.new(.35,0, ySize.Scale, ySize.Offset)
	elseif numButtons >= 3 then
		local spacing = .1 / numButtons
		local buttonSize = .9 / numButtons

		buttonNum = 1
		while buttonNum <= numButtons do
			buttonObjs[buttonNum].Position = UDim2.new(spacing*buttonNum + (buttonNum-1) * buttonSize, 0, yPos.Scale, yPos.Offset)
			buttonObjs[buttonNum].Size = UDim2.new(buttonSize, 0, ySize.Scale, ySize.Offset)
			buttonNum = buttonNum + 1
		end
	end
end

local function setSliderPos(newAbsPosX,slider,sliderPosition,bar,steps)

	local newStep = steps - 1 --otherwise we really get one more step than we want
	
	local relativePosX = math.min(1, math.max(0, (newAbsPosX - bar.AbsolutePosition.X) / bar.AbsoluteSize.X ) )
	local wholeNum, remainder = math.modf(relativePosX * newStep)
	if remainder > 0.5 then
		wholeNum = wholeNum + 1
	end
	relativePosX = wholeNum/newStep

	local result = math.ceil(relativePosX * newStep)
	if sliderPosition.Value ~= (result + 1) then --onky update if we moved a step
		sliderPosition.Value = result + 1
		
		if relativePosX == 1 then
			slider.Position = UDim2.new(1,-slider.AbsoluteSize.X,slider.Position.Y.Scale,slider.Position.Y.Offset)
		else
			slider.Position = UDim2.new(relativePosX,0,slider.Position.Y.Scale,slider.Position.Y.Offset)
		end
	end
	
end

local function cancelSlide(areaSoak)
	areaSoak.Visible = false
	if areaSoakMouseMoveCon then areaSoakMouseMoveCon:disconnect() end
end

RbxGuiLib.CreateStyledMessageDialog = function(title, message, style, buttons)
	local frame = Instance.new("Frame")
	frame.Size = UDim2.new(0.5, 0, 0, 165)
	frame.Position = UDim2.new(0.25, 0, 0.5, -72.5)
	frame.Name = "MessageDialog"
	frame.Active = true
	frame.Style = Enum.FrameStyle.RobloxRound	
	
	local styleImage = Instance.new("ImageLabel")
	styleImage.Name = "StyleImage"
	styleImage.BackgroundTransparency = 1
	styleImage.Position = UDim2.new(0,5,0,15)
	if style == "error" or style == "Error" then
		styleImage.Size = UDim2.new(0, 71, 0, 71)
		styleImage.Image = "rbxasset://textures/ui/Error.png"
	elseif style == "notify" or style == "Notify" then
		styleImage.Size = UDim2.new(0, 71, 0, 71)
		styleImage.Image = "rbxasset://textures/ui/Notify.png"
	elseif style == "confirm" or style == "Confirm" then
		styleImage.Size = UDim2.new(0, 74, 0, 76)
		styleImage.Image = "rbxasset://textures/ui/Confirm.png"
	else
		return RbxGuiLib.CreateMessageDialog(title,message,buttons)
	end
	styleImage.Parent = frame
	
	local titleLabel = Instance.new("TextLabel")
	titleLabel.Name = "Title"
	titleLabel.Text = title
	titleLabel.BackgroundTransparency = 1
	titleLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	titleLabel.Position = UDim2.new(0, 80, 0, 0)
	titleLabel.Size = UDim2.new(1, -80, 0, 40)
	titleLabel.Font = Enum.Font.ArialBold
	titleLabel.FontSize = Enum.FontSize.Size36
	titleLabel.TextXAlignment = Enum.TextXAlignment.Center
	titleLabel.TextYAlignment = Enum.TextYAlignment.Center
	titleLabel.Parent = frame

	local messageLabel = Instance.new("TextLabel")
	messageLabel.Name = "Message"
	messageLabel.Text = message
	messageLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	messageLabel.Position = UDim2.new(0.025, 80, 0, 45)
	messageLabel.Size = UDim2.new(0.95, -80, 0, 55)
	messageLabel.BackgroundTransparency = 1
	messageLabel.Font = Enum.Font.Arial
	messageLabel.FontSize = Enum.FontSize.Size18
	messageLabel.TextWrap = true
	messageLabel.TextXAlignment = Enum.TextXAlignment.Left
	messageLabel.TextYAlignment = Enum.TextYAlignment.Top
	messageLabel.Parent = frame

	CreateButtons(frame, buttons, UDim.new(0, 105), UDim.new(0, 40) )

	return frame
end

RbxGuiLib.CreateMessageDialog = function(title, message, buttons)
	local frame = Instance.new("Frame")
	frame.Size = UDim2.new(0.5, 0, 0.5, 0)
	frame.Position = UDim2.new(0.25, 0, 0.25, 0)
	frame.Name = "MessageDialog"
	frame.Active = true
	frame.Style = Enum.FrameStyle.RobloxRound

	local titleLabel = Instance.new("TextLabel")
	titleLabel.Name = "Title"
	titleLabel.Text = title
	titleLabel.BackgroundTransparency = 1
	titleLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	titleLabel.Position = UDim2.new(0, 0, 0, 0)
	titleLabel.Size = UDim2.new(1, 0, 0.15, 0)
	titleLabel.Font = Enum.Font.ArialBold
	titleLabel.FontSize = Enum.FontSize.Size36
	titleLabel.TextXAlignment = Enum.TextXAlignment.Center
	titleLabel.TextYAlignment = Enum.TextYAlignment.Center
	titleLabel.Parent = frame

	local messageLabel = Instance.new("TextLabel")
	messageLabel.Name = "Message"
	messageLabel.Text = message
	messageLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	messageLabel.Position = UDim2.new(0.025, 0, 0.175, 0)
	messageLabel.Size = UDim2.new(0.95, 0, .55, 0)
	messageLabel.BackgroundTransparency = 1
	messageLabel.Font = Enum.Font.Arial
	messageLabel.FontSize = Enum.FontSize.Size18
	messageLabel.TextWrap = true
	messageLabel.TextXAlignment = Enum.TextXAlignment.Left
	messageLabel.TextYAlignment = Enum.TextYAlignment.Top
	messageLabel.Parent = frame

	CreateButtons(frame, buttons, UDim.new(0.8,0), UDim.new(0.15, 0))

	return frame
end

RbxGuiLib.CreateDropDownMenu = function(items, onSelect, forRoblox)
	local width = UDim.new(0, 100)
	local height = UDim.new(0, 32)

	local xPos = 0.055
	local frame = Instance.new("Frame")
	frame.Name = "DropDownMenu"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(width, height)

	local dropDownMenu = Instance.new("TextButton")
	dropDownMenu.Name = "DropDownMenuButton"
	dropDownMenu.TextWrap = true
	dropDownMenu.TextColor3 = Color3.new(1,1,1)
	dropDownMenu.Text = "Choose One"
	dropDownMenu.Font = Enum.Font.ArialBold
	dropDownMenu.FontSize = Enum.FontSize.Size18
	dropDownMenu.TextXAlignment = Enum.TextXAlignment.Left
	dropDownMenu.TextYAlignment = Enum.TextYAlignment.Center
	dropDownMenu.BackgroundTransparency = 1
	dropDownMenu.AutoButtonColor = true
	dropDownMenu.Style = Enum.ButtonStyle.RobloxButton
	dropDownMenu.Size = UDim2.new(1,0,1,0)
	dropDownMenu.Parent = frame
	dropDownMenu.ZIndex = 2

	local dropDownIcon = Instance.new("ImageLabel")
	dropDownIcon.Name = "Icon"
	dropDownIcon.Active = false
	dropDownIcon.Image = "rbxasset://textures/ui/DropDown.png"
	dropDownIcon.BackgroundTransparency = 1
	dropDownIcon.Size = UDim2.new(0,11,0,6)
	dropDownIcon.Position = UDim2.new(1,-11,0.5, -2)
	dropDownIcon.Parent = dropDownMenu
	dropDownIcon.ZIndex = 2
	
	local itemCount = #items
	local dropDownItemCount = #items
	local useScrollButtons = false
	if dropDownItemCount > 6 then
		useScrollButtons = true
		dropDownItemCount = 6
	end
	
	local droppedDownMenu = Instance.new("TextButton")
	droppedDownMenu.Name = "List"
	droppedDownMenu.Text = ""
	droppedDownMenu.BackgroundTransparency = 1
	--droppedDownMenu.AutoButtonColor = true
	droppedDownMenu.Style = Enum.ButtonStyle.RobloxButton
	droppedDownMenu.Visible = false
	droppedDownMenu.Active = true	--Blocks clicks
	droppedDownMenu.Position = UDim2.new(0,0,0,0)
	droppedDownMenu.Size = UDim2.new(1,0, (1 + dropDownItemCount)*.8, 0)
	droppedDownMenu.Parent = frame
	droppedDownMenu.ZIndex = 2

	local choiceButton = Instance.new("TextButton")
	choiceButton.Name = "ChoiceButton"
	choiceButton.BackgroundTransparency = 1
	choiceButton.BorderSizePixel = 0
	choiceButton.Text = "ReplaceMe"
	choiceButton.TextColor3 = Color3.new(1,1,1)
	choiceButton.TextXAlignment = Enum.TextXAlignment.Left
	choiceButton.TextYAlignment = Enum.TextYAlignment.Center
	choiceButton.BackgroundColor3 = Color3.new(1, 1, 1)
	choiceButton.Font = Enum.Font.Arial
	choiceButton.FontSize = Enum.FontSize.Size18
	if useScrollButtons then
		choiceButton.Size = UDim2.new(1,-13, .8/((dropDownItemCount + 1)*.8),0) 
	else
		choiceButton.Size = UDim2.new(1, 0, .8/((dropDownItemCount + 1)*.8),0) 
	end
	choiceButton.TextWrap = true
	choiceButton.ZIndex = 2

	local dropDownSelected = false

	local scrollUpButton 
	local scrollDownButton
	local scrollMouseCount = 0

	local setZIndex = function(baseZIndex)
		droppedDownMenu.ZIndex = baseZIndex +1
		if scrollUpButton then
			scrollUpButton.ZIndex = baseZIndex + 3
		end
		if scrollDownButton then
			scrollDownButton.ZIndex = baseZIndex + 3
		end
		
		local children = droppedDownMenu:GetChildren()
		if children then
			for i, child in ipairs(children) do
				if child.Name == "ChoiceButton" then
					child.ZIndex = baseZIndex + 2
				elseif child.Name == "ClickCaptureButton" then
					child.ZIndex = baseZIndex
				end
			end
		end
	end

	local scrollBarPosition = 1
	local updateScroll = function()
		if scrollUpButton then
			scrollUpButton.Active = scrollBarPosition > 1 
		end
		if scrollDownButton then
			scrollDownButton.Active = scrollBarPosition + dropDownItemCount <= itemCount 
		end

		local children = droppedDownMenu:GetChildren()
		if not children then return end

		local childNum = 1			
		for i, obj in ipairs(children) do
			if obj.Name == "ChoiceButton" then
				if childNum < scrollBarPosition or childNum >= scrollBarPosition + dropDownItemCount then
					obj.Visible = false
				else
					obj.Position = UDim2.new(0,0,((childNum-scrollBarPosition+1)*.8)/((dropDownItemCount+1)*.8),0)
					obj.Visible = true
				end
				obj.TextColor3 = Color3.new(1,1,1)
				obj.BackgroundTransparency = 1

				childNum = childNum + 1
			end
		end
	end
	local toggleVisibility = function()
		dropDownSelected = not dropDownSelected

		dropDownMenu.Visible = not dropDownSelected
		droppedDownMenu.Visible = dropDownSelected
		if dropDownSelected then
			setZIndex(4)
		else
			setZIndex(2)
		end
		if useScrollButtons then
			updateScroll()
		end
	end
	droppedDownMenu.MouseButton1Click:connect(toggleVisibility)

	local updateSelection = function(text)
		local foundItem = false
		local children = droppedDownMenu:GetChildren()
		local childNum = 1
		if children then
			for i, obj in ipairs(children) do
				if obj.Name == "ChoiceButton" then
					if obj.Text == text then
						obj.Font = Enum.Font.ArialBold
						foundItem = true			
						scrollBarPosition = childNum
					else
						obj.Font = Enum.Font.Arial
					end
					childNum = childNum + 1
				end
			end
		end
		if not text then
			dropDownMenu.Text = "Choose One"
			scrollBarPosition = 1
		else
			if not foundItem then
				error("Invalid Selection Update -- " .. text)
			end

			if scrollBarPosition + dropDownItemCount > itemCount + 1 then
				scrollBarPosition = itemCount - dropDownItemCount + 1
			end

			dropDownMenu.Text = text
		end
	end
	
	local function scrollDown()
		if scrollBarPosition + dropDownItemCount <= itemCount then
			scrollBarPosition = scrollBarPosition + 1
			updateScroll()
			return true
		end
		return false
	end
	local function scrollUp()
		if scrollBarPosition > 1 then
			scrollBarPosition = scrollBarPosition - 1
			updateScroll()
			return true
		end
		return false
	end
	
	if useScrollButtons then
		--Make some scroll buttons
		scrollUpButton = Instance.new("ImageButton")
		scrollUpButton.Name = "ScrollUpButton"
		scrollUpButton.BackgroundTransparency = 1
		scrollUpButton.Image = "rbxasset://textures/ui/scrollbuttonUp.png"
		scrollUpButton.Size = UDim2.new(0,17,0,17) 
		scrollUpButton.Position = UDim2.new(1,-11,(1*.8)/((dropDownItemCount+1)*.8),0)
		scrollUpButton.MouseButton1Click:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollUpButton.MouseLeave:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollUpButton.MouseButton1Down:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
	
				scrollUp()
				local val = scrollMouseCount
				wait(0.5)
				while val == scrollMouseCount do
					if scrollUp() == false then
						break
					end
					wait(0.1)
				end				
			end)

		scrollUpButton.Parent = droppedDownMenu

		scrollDownButton = Instance.new("ImageButton")
		scrollDownButton.Name = "ScrollDownButton"
		scrollDownButton.BackgroundTransparency = 1
		scrollDownButton.Image = "rbxasset://textures/ui/scrollbuttonDown.png"
		scrollDownButton.Size = UDim2.new(0,17,0,17) 
		scrollDownButton.Position = UDim2.new(1,-11,1,-11)
		scrollDownButton.Parent = droppedDownMenu
		scrollDownButton.MouseButton1Click:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollDownButton.MouseLeave:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollDownButton.MouseButton1Down:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1

				scrollDown()
				local val = scrollMouseCount
				wait(0.5)
				while val == scrollMouseCount do
					if scrollDown() == false then
						break
					end
					wait(0.1)
				end				
			end)	

		local scrollbar = Instance.new("ImageLabel")
		scrollbar.Name = "ScrollBar"
		scrollbar.Image = "rbxasset://textures/ui/scrollbar.png"
		scrollbar.BackgroundTransparency = 1
		scrollbar.Size = UDim2.new(0, 18, (dropDownItemCount*.8)/((dropDownItemCount+1)*.8), -(17) - 11 - 4)
		scrollbar.Position = UDim2.new(1,-11,(1*.8)/((dropDownItemCount+1)*.8),17+2)
		scrollbar.Parent = droppedDownMenu
	end

	for i,item in ipairs(items) do
		-- needed to maintain local scope for items in event listeners below
		local button = choiceButton:clone()
		if forRoblox then
			button.RobloxLocked = true
		end		
		button.Text = item
		button.Parent = droppedDownMenu
		button.MouseButton1Click:connect(function()
			--Remove Highlight
			button.TextColor3 = Color3.new(1,1,1)
			button.BackgroundTransparency = 1

			updateSelection(item)
			onSelect(item)

			toggleVisibility()
		end)
		button.MouseEnter:connect(function()
			--Add Highlight	
			button.TextColor3 = Color3.new(0,0,0)
			button.BackgroundTransparency = 0
		end)

		button.MouseLeave:connect(function()
			--Remove Highlight
			button.TextColor3 = Color3.new(1,1,1)
			button.BackgroundTransparency = 1
		end)
	end

	--This does the initial layout of the buttons	
	updateScroll()

	local bigFakeButton = Instance.new("TextButton")
	bigFakeButton.BackgroundTransparency = 1
	bigFakeButton.Name = "ClickCaptureButton"
	bigFakeButton.Size = UDim2.new(0, 4000, 0, 3000)
	bigFakeButton.Position = UDim2.new(0, -2000, 0, -1500)
	bigFakeButton.ZIndex = 1
	bigFakeButton.Text = ""
	bigFakeButton.Parent = droppedDownMenu
	bigFakeButton.MouseButton1Click:connect(toggleVisibility)

	dropDownMenu.MouseButton1Click:connect(toggleVisibility)
	return frame, updateSelection
end

RbxGuiLib.CreatePropertyDropDownMenu = function(instance, property, enum)

	local items = enum:GetEnumItems()
	local names = {}
	local nameToItem = {}
	for i,obj in ipairs(items) do
		names[i] = obj.Name
		nameToItem[obj.Name] = obj
	end

	local frame
	local updateSelection
	frame, updateSelection = RbxGuiLib.CreateDropDownMenu(names, function(text) instance[property] = nameToItem[text] end)

	ScopedConnect(frame, instance, "Changed", 
		function(prop)
			if prop == property then
				updateSelection(instance[property].Name)
			end
		end,
		function()
			updateSelection(instance[property].Name)
		end)

	return frame
end

RbxGuiLib.GetFontHeight = function(font, fontSize)
	if font == nil or fontSize == nil then
		error("Font and FontSize must be non-nil")
	end

	if font == Enum.Font.Legacy then
		if fontSize == Enum.FontSize.Size8 then
			return 12
		elseif fontSize == Enum.FontSize.Size9 then
			return 14
		elseif fontSize == Enum.FontSize.Size10 then
			return 15
		elseif fontSize == Enum.FontSize.Size11 then
			return 17
		elseif fontSize == Enum.FontSize.Size12 then
			return 18
		elseif fontSize == Enum.FontSize.Size14 then
			return 21
		elseif fontSize == Enum.FontSize.Size18 then
			return 27
		elseif fontSize == Enum.FontSize.Size24 then
			return 36
		elseif fontSize == Enum.FontSize.Size36 then
			return 54
		elseif fontSize == Enum.FontSize.Size48 then
			return 72
		else
			error("Unknown FontSize")
		end
	elseif font == Enum.Font.Arial or font == Enum.Font.ArialBold then
		if fontSize == Enum.FontSize.Size8 then
			return 8
		elseif fontSize == Enum.FontSize.Size9 then
			return 9
		elseif fontSize == Enum.FontSize.Size10 then
			return 10
		elseif fontSize == Enum.FontSize.Size11 then
			return 11
		elseif fontSize == Enum.FontSize.Size12 then
			return 12
		elseif fontSize == Enum.FontSize.Size14 then
			return 14
		elseif fontSize == Enum.FontSize.Size18 then
			return 18
		elseif fontSize == Enum.FontSize.Size24 then
			return 24
		elseif fontSize == Enum.FontSize.Size36 then
			return 36
		elseif fontSize == Enum.FontSize.Size48 then
			return 48
		else
			error("Unknown FontSize")
		end
	else
		error("Unknown Font " .. font)
	end
end

local function layoutGuiObjectsHelper(frame, guiObjects, settingsTable)
	local totalPixels = frame.AbsoluteSize.Y
	local pixelsRemaining = frame.AbsoluteSize.Y
	for i, child in ipairs(guiObjects) do
		if child:IsA("TextLabel") or child:IsA("TextButton") then
			local isLabel = child:IsA("TextLabel")
			if isLabel then
				pixelsRemaining = pixelsRemaining - settingsTable["TextLabelPositionPadY"]
			else
				pixelsRemaining = pixelsRemaining - settingsTable["TextButtonPositionPadY"]
			end
			child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
			child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, pixelsRemaining)

			if child.TextFits and child.TextBounds.Y < pixelsRemaining then
				child.Visible = true
				if isLabel then
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.TextBounds.Y + settingsTable["TextLabelSizePadY"])
				else 
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.TextBounds.Y + settingsTable["TextButtonSizePadY"])
				end

				while not child.TextFits do
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.AbsoluteSize.Y + 1)
				end
				pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y		

				if isLabel then
					pixelsRemaining = pixelsRemaining - settingsTable["TextLabelPositionPadY"]
				else
					pixelsRemaining = pixelsRemaining - settingsTable["TextButtonPositionPadY"]
				end
			else
				child.Visible = false
				pixelsRemaining = -1
			end			

		else
			--GuiObject
			child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
			pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y
			child.Visible = (pixelsRemaining >= 0)
		end
	end
end

RbxGuiLib.LayoutGuiObjects = function(frame, guiObjects, settingsTable)
	if not frame:IsA("GuiObject") then
		error("Frame must be a GuiObject")
	end
	for i, child in ipairs(guiObjects) do
		if not child:IsA("GuiObject") then
			error("All elements that are layed out must be of type GuiObject")
		end
	end

	if not settingsTable then
		settingsTable = {}
	end

	if not settingsTable["TextLabelSizePadY"] then
		settingsTable["TextLabelSizePadY"] = 0
	end
	if not settingsTable["TextLabelPositionPadY"] then
		settingsTable["TextLabelPositionPadY"] = 0
	end
	if not settingsTable["TextButtonSizePadY"] then
		settingsTable["TextButtonSizePadY"] = 12
	end
	if not settingsTable["TextButtonPositionPadY"] then
		settingsTable["TextButtonPositionPadY"] = 2
	end

	--Wrapper frame takes care of styled objects
	local wrapperFrame = Instance.new("Frame")
	wrapperFrame.Name = "WrapperFrame"
	wrapperFrame.BackgroundTransparency = 1
	wrapperFrame.Size = UDim2.new(1,0,1,0)
	wrapperFrame.Parent = frame

	for i, child in ipairs(guiObjects) do
		child.Parent = wrapperFrame
	end

	local recalculate = function()
		wait()
		layoutGuiObjectsHelper(wrapperFrame, guiObjects, settingsTable)
	end
	
	frame.Changed:connect(
		function(prop)
			if prop == "AbsoluteSize" then
				--Wait a heartbeat for it to sync in
				recalculate()
			end
		end)
	frame.AncestryChanged:connect(recalculate)

	layoutGuiObjectsHelper(wrapperFrame, guiObjects, settingsTable)
end


RbxGuiLib.CreateSlider = function(steps,width,position)
	local sliderGui = Instance.new("Frame")
	sliderGui.Size = UDim2.new(1,0,1,0)
	sliderGui.BackgroundTransparency = 1
	sliderGui.Name = "SliderGui"
	
	local areaSoak = Instance.new("TextButton")
	areaSoak.Name = "AreaSoak"
	areaSoak.Text = ""
	areaSoak.BackgroundTransparency = 1
	areaSoak.Active = false
	areaSoak.Size = UDim2.new(1,0,1,0)
	areaSoak.Visible = false
	areaSoak.ZIndex = 4
	areaSoak.Parent = sliderGui
	
	local sliderPosition = Instance.new("IntValue")
	sliderPosition.Name = "SliderPosition"
	sliderPosition.Value = 0
	sliderPosition.Parent = sliderGui
	
	local id = math.random(1,100)
	
	local bar = Instance.new("Frame")
	bar.Name = "Bar"
	bar.BackgroundColor3 = Color3.new(0,0,0)
	if type(width) == "number" then
		bar.Size = UDim2.new(0,width,0,5)
	else
		bar.Size = UDim2.new(0,200,0,5)
	end
	bar.BorderColor3 = Color3.new(95/255,95/255,95/255)
	bar.ZIndex = 2
	bar.Parent = sliderGui
	
	if position["X"] and position["X"]["Scale"] and position["X"]["Offset"] and position["Y"] and position["Y"]["Scale"] and position["Y"]["Offset"] then
		bar.Position = position
	end
	
	local slider = Instance.new("ImageButton")
	slider.Name = "Slider"
	slider.BackgroundTransparency = 1
	slider.Image = "rbxasset://textures/ui/Slider.png"
	slider.Position = UDim2.new(0,0,0.5,-10)
	slider.Size = UDim2.new(0,20,0,20)
	slider.ZIndex = 3
	slider.Parent = bar
	
	local areaSoakMouseMoveCon = nil
	
	areaSoak.MouseLeave:connect(function()
		if areaSoak.Visible then
			cancelSlide(areaSoak)
		end
	end)
	areaSoak.MouseButton1Up:connect(function()
		if areaSoak.Visible then
			cancelSlide(areaSoak)
		end
	end)
	
	slider.MouseButton1Down:connect(function()
		areaSoak.Visible = true
		if areaSoakMouseMoveCon then areaSoakMouseMoveCon:disconnect() end
		areaSoakMouseMoveCon = areaSoak.MouseMoved:connect(function(x,y)
			setSliderPos(x,slider,sliderPosition,bar,steps)
		end)
	end)
	
	slider.MouseButton1Up:connect(function() cancelSlide(areaSoak) end)
	
	sliderPosition.Changed:connect(function(prop)
		sliderPosition.Value = math.min(steps, math.max(1,sliderPosition.Value))
		local relativePosX = (sliderPosition.Value) / steps
		if relativePosX >= 1 then
			slider.Position = UDim2.new(relativePosX,-20,slider.Position.Y.Scale,slider.Position.Y.Offset)
		else
			slider.Position = UDim2.new(relativePosX,0,slider.Position.Y.Scale,slider.Position.Y.Offset)
		end
	end)
	
	return sliderGui, sliderPosition

end


RbxGuiLib.CreateScrollingFrame = function(orderList,scrollStyle)
	local frame = Instance.new("Frame")
	frame.Name = "ScrollingFrame"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(1,0,1,0)
	
	local scrollUpButton = Instance.new("ImageButton")
	scrollUpButton.Name = "ScrollUpButton"
	scrollUpButton.BackgroundTransparency = 1
	scrollUpButton.Image = "rbxasset://textures/ui/scrollbuttonUp.png"
	scrollUpButton.Size = UDim2.new(0,17,0,17) 

	
	local scrollDownButton = Instance.new("ImageButton")
	scrollDownButton.Name = "ScrollDownButton"
	scrollDownButton.BackgroundTransparency = 1
	scrollDownButton.Image = "rbxasset://textures/ui/scrollbuttonDown.png"
	scrollDownButton.Size = UDim2.new(0,17,0,17) 

	local style = "simple"
	if scrollStyle and tostring(scrollStyle) then
		style = scrollStyle
	end
	
	local scrollPosition = 1
	local rowSize = 1
	
	local layoutGridScrollBar = function()
		local guiObjects = {}
		if orderList then
			for i, child in ipairs(orderList) do
				if child.Parent == frame then
					table.insert(guiObjects, child)
				end
			end
		else
			local children = frame:GetChildren()
			if children then
				for i, child in ipairs(children) do 
					if child:IsA("GuiObject") then
						table.insert(guiObjects, child)
					end
				end
			end
		end
		if #guiObjects == 0 then
			scrollUpButton.Active = false
			scrollDownButton.Active = false
			scrollPosition = 1
			return
		end

		if scrollPosition > #guiObjects then
			scrollPosition = #guiObjects
		end
		
		local totalPixelsY = frame.AbsoluteSize.Y
		local pixelsRemainingY = frame.AbsoluteSize.Y
		
		local totalPixelsX  = frame.AbsoluteSize.X
		
		local xCounter = 0
		local rowSizeCounter = 0
		local setRowSize = true

		local pixelsBelowScrollbar = 0
		local pos = #guiObjects
		while pixelsBelowScrollbar < totalPixelsY and pos >= 1 do
			if pos >= scrollPosition then
				pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
			else
				xCounter = xCounter + guiObjects[pos].AbsoluteSize.X
				rowSizeCounter = rowSizeCounter + 1
				if xCounter >= totalPixelsX then
					if setRowSize then
						rowSize = rowSizeCounter - 1
						setRowSize = false
					end
					
					rowSizeCounter = 0
					xCounter = 0
					if pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y <= totalPixelsY then
						--It fits, so back up our scroll position
						pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
						if scrollPosition <= rowSize then
							scrollPosition = rowSize 
							break
						else
							--print("Backing up ScrollPosition from -- " ..scrollPosition)
							scrollPosition = scrollPosition - rowSize 
						end
					else
						break
					end
				end
			end
			pos = pos - 1
		end

		xCounter = 0
		--print("ScrollPosition = " .. scrollPosition)
		pos = scrollPosition
		rowSizeCounter = 0
		setRowSize = true
		local lastChildSize = 0
		
		local xOffset,yOffset = 0
		if guiObjects[1] then
			yOffset = math.ceil(math.floor(math.fmod(totalPixelsY,guiObjects[1].AbsoluteSize.X))/2)
			xOffset = math.ceil(math.floor(math.fmod(totalPixelsX,guiObjects[1].AbsoluteSize.Y))/2)
		end
		
		for i, child in ipairs(guiObjects) do
			if i < scrollPosition then
				--print("Hiding " .. child.Name)
				child.Visible = false
			else
				if pixelsRemainingY < 0 then
					--print("Out of Space " .. child.Name)
					child.Visible = false
				else
					--print("Laying out " .. child.Name)
					--GuiObject
					if setRowSize then rowSizeCounter = rowSizeCounter + 1 end
					if xCounter + child.AbsoluteSize.X >= totalPixelsX then
						if setRowSize then
							rowSize = rowSizeCounter - 1
							setRowSize = false
						end
						xCounter = 0
						pixelsRemainingY = pixelsRemainingY - child.AbsoluteSize.Y
					end
					child.Position = UDim2.new(child.Position.X.Scale,xCounter + xOffset, 0, totalPixelsY - pixelsRemainingY + yOffset)
					xCounter = xCounter + child.AbsoluteSize.X
					child.Visible = ((pixelsRemainingY - child.AbsoluteSize.Y) >= 0)
					lastChildSize = child.AbsoluteSize				
				end
			end
		end

		scrollUpButton.Active = (scrollPosition > 1)
		if lastChildSize == 0 then 
			scrollDownButton.Active = false
		else
			scrollDownButton.Active = ((pixelsRemainingY - lastChildSize.Y) < 0)
		end
	end


	local layoutSimpleScrollBar = function()
		local guiObjects = {}	
		
		if orderList then
			for i, child in ipairs(orderList) do
				if child.Parent == frame then
					table.insert(guiObjects, child)
				end
			end
		else
			local children = frame:GetChildren()
			if children then
				for i, child in ipairs(children) do 
					if child:IsA("GuiObject") then
						table.insert(guiObjects, child)
					end
				end
			end
		end
		if #guiObjects == 0 then
			scrollUpButton.Active = false
			scrollDownButton.Active = false
			scrollPosition = 1
			return
		end

		if scrollPosition > #guiObjects then
			scrollPosition = #guiObjects
		end
		
		local totalPixels = frame.AbsoluteSize.Y
		local pixelsRemaining = frame.AbsoluteSize.Y

		local pixelsBelowScrollbar = 0
		local pos = #guiObjects
		while pixelsBelowScrollbar < totalPixels and pos >= 1 do
			if pos >= scrollPosition then
				pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
			else
				if pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y <= totalPixels then
					--It fits, so back up our scroll position
					pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
					if scrollPosition <= 1 then
						scrollPosition = 1
						break
					else
						--print("Backing up ScrollPosition from -- " ..scrollPosition)
						scrollPosition = scrollPosition - 1
					end
				else
					break
				end
			end
			pos = pos - 1
		end

		--print("ScrollPosition = " .. scrollPosition)
		pos = scrollPosition
		for i, child in ipairs(guiObjects) do
			if i < scrollPosition then
				--print("Hiding " .. child.Name)
				child.Visible = false
			else
				if pixelsRemaining < 0 then
					--print("Out of Space " .. child.Name)
					child.Visible = false
				else
					--print("Laying out " .. child.Name)
					--GuiObject
					child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
					pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y
					child.Visible = (pixelsRemaining >= 0)				
				end
			end
		end
		scrollUpButton.Active = (scrollPosition > 1)
		scrollDownButton.Active = (pixelsRemaining < 0)
	end

	local reentrancyGuard = false
	local recalculate = function()
		if reentrancyGuard then
			return
		end
		reentrancyGuard = true
		wait()
		local success, err = nil
		if style == "grid" then
			success, err = pcall(function() layoutGridScrollBar(frame) end)
		elseif style == "simple" then
			success, err = pcall(function() layoutSimpleScrollBar(frame) end)
		end
		if not success then print(err) end

		reentrancyGuard = false
	end

	local scrollUp = function()
		if scrollUpButton.Active then
			scrollPosition = scrollPosition - rowSize
			recalculate()
		end
	end

	local scrollDown = function()
		if scrollDownButton.Active then
			scrollPosition = scrollPosition + rowSize
			recalculate()
		end
	end

	local scrollMouseCount = 0
	scrollUpButton.MouseButton1Click:connect(
		function()
			--print("Up-MouseButton1Click")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollUpButton.MouseLeave:connect(
		function()
			--print("Up-Leave")
			scrollMouseCount = scrollMouseCount + 1
		end)

	scrollUpButton.MouseButton1Down:connect(
		function()
			--print("Up-Down")
			scrollMouseCount = scrollMouseCount + 1

			scrollUp()
			local val = scrollMouseCount
			wait(0.5)
			while val == scrollMouseCount do
				if scrollUp() == false then
					break
				end
				wait(0.1)
			end				
		end)

	scrollDownButton.MouseButton1Click:connect(
		function()
			--print("Down-Click")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollDownButton.MouseLeave:connect(
		function()
			--print("Down-Leave")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollDownButton.MouseButton1Down:connect(
		function()
			--print("Down-Down")
			scrollMouseCount = scrollMouseCount + 1

			scrollDown()
			local val = scrollMouseCount
			wait(0.5)
			while val == scrollMouseCount do
				if scrollDown() == false then
					break
				end
				wait(0.1)
			end				
		end)


	frame.ChildAdded:connect(function()
		recalculate()
	end)

	frame.ChildRemoved:connect(function()
		recalculate()
	end)
	
	frame.Changed:connect(
		function(prop)
			if prop == "AbsoluteSize" then
				--Wait a heartbeat for it to sync in
				recalculate()
			end
		end)
	frame.AncestryChanged:connect(recalculate)

	return frame, scrollUpButton, scrollDownButton, recalculate
end
local function binaryGrow(min, max, fits)
	if min > max then
		return min
	end
	local biggestLegal = min

	while min <= max do
		local mid = min + math.floor((max - min) / 2)
		if fits(mid) and (biggestLegal == nil or biggestLegal < mid) then
			biggestLegal = mid
			
			--Try growing
			min = mid + 1
		else
			--Doesn't fit, shrink
			max = mid - 1
		end
	end
	return biggestLegal
end


local function binaryShrink(min, max, fits)
	if min > max then
		return min
	end
	local smallestLegal = max

	while min <= max do
		local mid = min + math.floor((max - min) / 2)
		if fits(mid) and (smallestLegal == nil or smallestLegal > mid) then
			smallestLegal = mid
			
			--It fits, shrink
			max = mid - 1			
		else
			--Doesn't fit, grow
			min = mid + 1
		end
	end
	return smallestLegal
end


local function getGuiOwner(instance)
	while instance ~= nil do
		if instance:IsA("ScreenGui") or instance:IsA("BillboardGui")  then
			return instance
		end
		instance = instance.Parent
	end
	return nil
end

RbxGuiLib.AutoTruncateTextObject = function(textLabel)
	local text = textLabel.Text

	local fullLabel = textLabel:Clone()
	fullLabel.Name = "Full" .. textLabel.Name 
	fullLabel.BorderSizePixel = 0
	fullLabel.BackgroundTransparency = 0
	fullLabel.Text = text
	fullLabel.TextXAlignment = Enum.TextXAlignment.Center
	fullLabel.Position = UDim2.new(0,-3,0,0)
	fullLabel.Size = UDim2.new(0,100,1,0)
	fullLabel.Visible = false
	fullLabel.Parent = textLabel

	local shortText = nil
	local mouseEnterConnection = nil
	local mouseLeaveConnection= nil

	local checkForResize = function()
		if getGuiOwner(textLabel) == nil then
			return
		end
		textLabel.Text = text
		if textLabel.TextFits then 
			--Tear down the rollover if it is active
			if mouseEnterConnection then
				mouseEnterConnection:disconnect()
				mouseEnterConnection = nil
			end
			if mouseLeaveConnection then
				mouseLeaveConnection:disconnect()
				mouseLeaveConnection = nil
			end
		else
			local len = string.len(text)
			textLabel.Text = text .. "~"

			--Shrink the text
			local textSize = binaryGrow(0, len, 
				function(pos)
					if pos == 0 then
						textLabel.Text = "~"
					else
						textLabel.Text = string.sub(text, 1, pos) .. "~"
					end
					return textLabel.TextFits
				end)
			shortText = string.sub(text, 1, textSize) .. "~"
			textLabel.Text = shortText
			
			--Make sure the fullLabel fits
			if not fullLabel.TextFits then
				--Already too small, grow it really bit to start
				fullLabel.Size = UDim2.new(0, 10000, 1, 0)
			end
			
			--Okay, now try to binary shrink it back down
			local fullLabelSize = binaryShrink(textLabel.AbsoluteSize.X,fullLabel.AbsoluteSize.X, 
				function(size)
					fullLabel.Size = UDim2.new(0, size, 1, 0)
					return fullLabel.TextFits
				end)
			fullLabel.Size = UDim2.new(0,fullLabelSize+6,1,0)

			--Now setup the rollover effects, if they are currently off
			if mouseEnterConnection == nil then
				mouseEnterConnection = textLabel.MouseEnter:connect(
					function()
						fullLabel.ZIndex = textLabel.ZIndex + 1
						fullLabel.Visible = true
						--textLabel.Text = ""
					end)
			end
			if mouseLeaveConnection == nil then
				mouseLeaveConnection = textLabel.MouseLeave:connect(
					function()
						fullLabel.Visible = false
						--textLabel.Text = shortText
					end)
			end
		end
	end
	textLabel.AncestryChanged:connect(checkForResize)
	textLabel.Changed:connect(
		function(prop) 
			if prop == "AbsoluteSize" then 
				checkForResize() 	
			end 
		end)

	checkForResize()

	local function changeText(newText)
		text = newText
		fullLabel.Text = text
		checkForResize()
	end

	return textLabel, changeText
end

local function TransitionTutorialPages(fromPage, toPage, transitionFrame, currentPageValue)	
	if fromPage then
		fromPage.Visible = false
		if transitionFrame.Visible == false then
			transitionFrame.Size = fromPage.Size
			transitionFrame.Position = fromPage.Position
		end
	else
		if transitionFrame.Visible == false then
			transitionFrame.Size = UDim2.new(0.0,50,0.0,50)
			transitionFrame.Position = UDim2.new(0.5,-25,0.5,-25)
		end
	end
	transitionFrame.Visible = true
	currentPageValue.Value = nil

	local newsize, newPosition
	if toPage then
		--Make it visible so it resizes
		toPage.Visible = true

		newSize = toPage.Size
		newPosition = toPage.Position

		toPage.Visible = false
	else
		newSize = UDim2.new(0.0,50,0.0,50)
		newPosition = UDim2.new(0.5,-25,0.5,-25)
	end
	transitionFrame:TweenSizeAndPosition(newSize, newPosition, Enum.EasingDirection.InOut, Enum.EasingStyle.Quad, 0.3, true,
		function(state)
			if state == Enum.TweenStatus.Completed then
				transitionFrame.Visible = false
				if toPage then
					toPage.Visible = true
					currentPageValue.Value = toPage
				end
			end
		end)
end

RbxGuiLib.CreateTutorial = function(name, tutorialKey, createButtons)
	local frame = Instance.new("Frame")
	frame.Name = "Tutorial-" .. name
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(0.6, 0, 0.6, 0)
	frame.Position = UDim2.new(0.2, 0, 0.2, 0)

	local transitionFrame = Instance.new("Frame")
	transitionFrame.Name = "TransitionFrame"
	transitionFrame.Style = Enum.FrameStyle.RobloxRound
	transitionFrame.Size = UDim2.new(0.6, 0, 0.6, 0)
	transitionFrame.Position = UDim2.new(0.2, 0, 0.2, 0)
	transitionFrame.Visible = false
	transitionFrame.Parent = frame

	local currentPageValue = Instance.new("ObjectValue")
	currentPageValue.Name = "CurrentTutorialPage"
	currentPageValue.Value = nil
	currentPageValue.Parent = frame

	local boolValue = Instance.new("BoolValue")
	boolValue.Name = "Buttons"
	boolValue.Value = createButtons
	boolValue.Parent = frame

	local pages = Instance.new("Frame")
	pages.Name = "Pages"
	pages.BackgroundTransparency = 1
	pages.Size = UDim2.new(1,0,1,0)
	pages.Parent = frame

	local function getVisiblePageAndHideOthers()
		local visiblePage = nil
		local children = pages:GetChildren()
		if children then
			for i,child in ipairs(children) do
				if child.Visible then
					if visiblePage then
						child.Visible = false
					else
						visiblePage = child
					end
				end
			end
		end
		return visiblePage
	end

	local showTutorial = function(alwaysShow)
		if alwaysShow or UserSettings().GameSettings:GetTutorialState(tutorialKey) == false then
			print("Showing tutorial-",tutorialKey)
			local currentTutorialPage = getVisiblePageAndHideOthers()

			local firstPage = pages:FindFirstChild("TutorialPage1")
			if firstPage then
				TransitionTutorialPages(currentTutorialPage, firstPage, transitionFrame, currentPageValue)	
			else
				error("Could not find TutorialPage1")
			end
		end
	end

	local dismissTutorial = function()
		local currentTutorialPage = getVisiblePageAndHideOthers()

		if currentTutorialPage then
			TransitionTutorialPages(currentTutorialPage, nil, transitionFrame, currentPageValue)
		end

		UserSettings().GameSettings:SetTutorialState(tutorialKey, true)
	end

	local gotoPage = function(pageNum)
		local page = pages:FindFirstChild("TutorialPage" .. pageNum)
		local currentTutorialPage = getVisiblePageAndHideOthers()
		TransitionTutorialPages(currentTutorialPage, page, transitionFrame, currentPageValue)
	end

	return frame, showTutorial, dismissTutorial, gotoPage
end 

local function CreateBasicTutorialPage(name, handleResize, skipTutorial)
	local frame = Instance.new("Frame")
	frame.Name = "TutorialPage"
	frame.Style = Enum.FrameStyle.RobloxRound
	frame.Size = UDim2.new(0.6, 0, 0.6, 0)
	frame.Position = UDim2.new(0.2, 0, 0.2, 0)
	frame.Visible = false
	
	local frameHeader = Instance.new("TextLabel")
	frameHeader.Name = "Header"
	frameHeader.Text = name
	frameHeader.BackgroundTransparency = 1
	frameHeader.FontSize = Enum.FontSize.Size24
	frameHeader.Font = Enum.Font.ArialBold
	frameHeader.TextColor3 = Color3.new(1,1,1)
	frameHeader.TextXAlignment = Enum.TextXAlignment.Center
	frameHeader.TextWrap = true
	frameHeader.Size = UDim2.new(1,-55, 0, 22)
	frameHeader.Position = UDim2.new(0,0,0,0)
	frameHeader.Parent = frame

	local skipButton = Instance.new("ImageButton")
	skipButton.Name = "SkipButton"
	skipButton.AutoButtonColor = false
	skipButton.BackgroundTransparency = 1
	skipButton.Image = "rbxasset://textures/ui/Skip.png"	
	skipButton.MouseButton1Click:connect(function()
		skipButton.Image = "rbxasset://textures/ui/Skip.png"	
		skipTutorial()
	end)
	skipButton.MouseEnter:connect(function()
		skipButton.Image = "rbxasset://textures/ui/SkipEnter.png"	
	end)
	skipButton.MouseLeave:connect(function()
		skipButton.Image = "rbxasset://textures/ui/Skip.png"	
	end)
	skipButton.Size = UDim2.new(0, 55, 0, 22)
	skipButton.Position = UDim2.new(1, -55, 0, 0)
	skipButton.Parent = frame

	local innerFrame = Instance.new("Frame")
	innerFrame.Name = "ContentFrame"
	innerFrame.BackgroundTransparency = 1
	innerFrame.Position = UDim2.new(0,0,0,22)
	innerFrame.Parent = frame

	local nextButton = Instance.new("TextButton")
	nextButton.Name = "NextButton"
	nextButton.Text = "Next"
	nextButton.TextColor3 = Color3.new(1,1,1)
	nextButton.Font = Enum.Font.Arial
	nextButton.FontSize = Enum.FontSize.Size18
	nextButton.Style = Enum.ButtonStyle.RobloxButtonDefault
	nextButton.Size = UDim2.new(0,80, 0, 32)
	nextButton.Position = UDim2.new(0.5, 5, 1, -32)
	nextButton.Active = false
	nextButton.Visible = false
	nextButton.Parent = frame

	local prevButton = Instance.new("TextButton")
	prevButton.Name = "PrevButton"
	prevButton.Text = "Previous"
	prevButton.TextColor3 = Color3.new(1,1,1)
	prevButton.Font = Enum.Font.Arial
	prevButton.FontSize = Enum.FontSize.Size18
	prevButton.Style = Enum.ButtonStyle.RobloxButton
	prevButton.Size = UDim2.new(0,80, 0, 32)
	prevButton.Position = UDim2.new(0.5, -85, 1, -32)
	prevButton.Active = false
	prevButton.Visible = false
	prevButton.Parent = frame

	innerFrame.Size = UDim2.new(1,0,1,-22-35)

	local parentConnection = nil

	local function basicHandleResize()
		if frame.Visible and frame.Parent then
			local maxSize = math.min(frame.Parent.AbsoluteSize.X, frame.Parent.AbsoluteSize.Y)
			handleResize(200,maxSize)
		end
	end

	frame.Changed:connect(
		function(prop)
			if prop == "Parent" then
				if parentConnection ~= nil then
					parentConnection:disconnect()
					parentConnection = nil
				end
				if frame.Parent and frame.Parent:IsA("GuiObject") then
					parentConnection = frame.Parent.Changed:connect(
						function(parentProp)
							if parentProp == "AbsoluteSize" then
								wait()
								basicHandleResize()
							end
						end)
					basicHandleResize()
				end
			end

			if prop == "Visible" then 
				basicHandleResize()
			end
		end)

	return frame, innerFrame
end

RbxGuiLib.CreateTextTutorialPage = function(name, text, skipTutorialFunc)
	local frame = nil
	local contentFrame = nil

	local textLabel = Instance.new("TextLabel")
	textLabel.BackgroundTransparency = 1
	textLabel.TextColor3 = Color3.new(1,1,1)
	textLabel.Text = text
	textLabel.TextWrap = true
	textLabel.TextXAlignment = Enum.TextXAlignment.Left
	textLabel.TextYAlignment = Enum.TextYAlignment.Center
	textLabel.Font = Enum.Font.Arial
	textLabel.FontSize = Enum.FontSize.Size14
	textLabel.Size = UDim2.new(1,0,1,0)

	local function handleResize(minSize, maxSize)
		size = binaryShrink(minSize, maxSize,
			function(size)
				frame.Size = UDim2.new(0, size, 0, size)
				return textLabel.TextFits
			end)
		frame.Size = UDim2.new(0, size, 0, size)
		frame.Position = UDim2.new(0.5, -size/2, 0.5, -size/2)
	end

	frame, contentFrame = CreateBasicTutorialPage(name, handleResize, skipTutorialFunc)
	textLabel.Parent = contentFrame

	return frame
end

RbxGuiLib.CreateImageTutorialPage = function(name, imageAsset, x, y, skipTutorialFunc)
	local frame = nil
	local contentFrame = nil

	local imageLabel = Instance.new("ImageLabel")
	imageLabel.BackgroundTransparency = 1
	imageLabel.Image = imageAsset
	imageLabel.Size = UDim2.new(0,x,0,y)
	imageLabel.Position = UDim2.new(0.5,-x/2,0.5,-y/2)

	local function handleResize(minSize, maxSize)
		size = binaryShrink(minSize, maxSize,
			function(size)
				return size >= x and size >= y
			end)
		if size >= x and size >= y then
			imageLabel.Size = UDim2.new(0,x, 0,y)
			imageLabel.Position = UDim2.new(0.5,-x/2, 0.5, -y/2)
		else
			if x > y then
				--X is limiter, so 
				imageLabel.Size = UDim2.new(1,0,y/x,0)
				imageLabel.Position = UDim2.new(0,0, 0.5 - (y/x)/2, 0)
			else
				--Y is limiter
				imageLabel.Size = UDim2.new(x/y,0,1, 0)
				imageLabel.Position = UDim2.new(0.5-(x/y)/2, 0, 0, 0)
			end
		end
		frame.Size = UDim2.new(0, size, 0, size)
		frame.Position = UDim2.new(0.5, -size/2, 0.5, -size/2)
	end

	frame, contentFrame = CreateBasicTutorialPage(name, handleResize, skipTutorialFunc)
	imageLabel.Parent = contentFrame

	return frame
end

RbxGuiLib.AddTutorialPage = function(tutorial, tutorialPage)
	local transitionFrame = tutorial.TransitionFrame
	local currentPageValue = tutorial.CurrentTutorialPage

	if not tutorial.Buttons.Value then
		tutorialPage.ContentFrame.Size = UDim2.new(1,0,1,-22)
		tutorialPage.NextButton.Parent = nil
		tutorialPage.PrevButton.Parent = nil
	end

	local children = tutorial.Pages:GetChildren()
	if children and #children > 0 then
		tutorialPage.Name = "TutorialPage" .. (#children+1)
		local previousPage = children[#children]
		if not previousPage:IsA("GuiObject") then
			error("All elements under Pages must be GuiObjects")
		end

		if tutorial.Buttons.Value then
			if previousPage.NextButton.Active then
				error("NextButton already Active on previousPage, please only add pages with RbxGui.AddTutorialPage function")
			end
			previousPage.NextButton.MouseButton1Click:connect(
				function()
					TransitionTutorialPages(previousPage, tutorialPage, transitionFrame, currentPageValue)
				end)
			previousPage.NextButton.Active = true
			previousPage.NextButton.Visible = true

			if tutorialPage.PrevButton.Active then
				error("PrevButton already Active on tutorialPage, please only add pages with RbxGui.AddTutorialPage function")
			end
			tutorialPage.PrevButton.MouseButton1Click:connect(
				function()
					TransitionTutorialPages(tutorialPage, previousPage, transitionFrame, currentPageValue)
				end)
			tutorialPage.PrevButton.Active = true
			tutorialPage.PrevButton.Visible = true
		end

		tutorialPage.Parent = tutorial.Pages
	else
		--First child
		tutorialPage.Name = "TutorialPage1"
		tutorialPage.Parent = tutorial.Pages
	end
end 

RbxGuiLib.Help = 
	function(funcNameOrFunc) 
		--input argument can be a string or a function.  Should return a description (of arguments and expected side effects)
		if funcNameOrFunc == "CreatePropertyDropDownMenu" or funcNameOrFunc == RbxGuiLib.CreatePropertyDropDownMenu then
			return "Function CreatePropertyDropDownMenu.  " ..
				   "Arguments: (instance, propertyName, enumType).  " .. 
				   "Side effect: returns a container with a drop-down-box that is linked to the 'property' field of 'instance' which is of type 'enumType'" 
		end 
		if funcNameOrFunc == "CreateDropDownMenu" or funcNameOrFunc == RbxGuiLib.CreateDropDownMenu then
			return "Function CreateDropDownMenu.  " .. 
			       "Arguments: (items, onItemSelected).  " .. 
				   "Side effect: Returns 2 results, a container to the gui object and a 'updateSelection' function for external updating.  The container is a drop-down-box created around a list of items" 
		end 
		if funcNameOrFunc == "CreateMessageDialog" or funcNameOrFunc == RbxGuiLib.CreateMessageDialog then
			return "Function CreateMessageDialog.  " .. 
			       "Arguments: (title, message, buttons). " .. 
			       "Side effect: Returns a gui object of a message box with 'title' and 'message' as passed in.  'buttons' input is an array of Tables contains a 'Text' and 'Function' field for the text/callback of each button"
		end		
		if funcNameOrFunc == "CreateStyledMessageDialog" or funcNameOrFunc == RbxGuiLib.CreateStyledMessageDialog then
			return "Function CreateStyledMessageDialog.  " .. 
			       "Arguments: (title, message, style, buttons). " .. 
			       "Side effect: Returns a gui object of a message box with 'title' and 'message' as passed in.  'buttons' input is an array of Tables contains a 'Text' and 'Function' field for the text/callback of each button, 'style' is a string, either Error, Notify or Confirm"
		end
		if funcNameOrFunc == "GetFontHeight" or funcNameOrFunc == RbxGuiLib.GetFontHeight then
			return "Function GetFontHeight.  " .. 
			       "Arguments: (font, fontSize). " .. 
			       "Side effect: returns the size in pixels of the given font + fontSize"
		end
		if funcNameOrFunc == "LayoutGuiObjects" or funcNameOrFunc == RbxGuiLib.LayoutGuiObjects then
		
		end
		if funcNameOrFunc == "CreateScrollingFrame" or funcNameOrFunc == RbxGuiLib.CreateScrollingFrame then
			return "Function CreateScrollingFrame.  " .. 
			   "Arguments: (orderList, style) " .. 
			   "Side effect: returns 4 objects, (scrollFrame, scrollUpButton, scrollDownButton, recalculateFunction).  'scrollFrame' can be filled with GuiObjects.  It will lay them out and allow scrollUpButton/scrollDownButton to interact with them.  Orderlist is optional (and specifies the order to layout the children.  Without orderlist, it uses the children order. style is also optional, and allows for a 'grid' styling if style is passed 'grid' as a string.  recalculateFunction can be called when a relayout is needed (when orderList changes)"
		end
		if funcNameOrFunc == "AutoTruncateTextObject" or funcNameOrFunc == RbxGuiLib.AutoTruncateTextObject then
			return "Function AutoTruncateTextObject.  " .. 
			   "Arguments: (textLabel) " .. 
			   "Side effect: returns 2 objects, (textLabel, changeText).  The 'textLabel' input is modified to automatically truncate text (with ellipsis), if it gets too small to fit.  'changeText' is a function that can be used to change the text, it takes 1 string as an argument"
		end
		if funcNameOrFunc == "CreateSlider" or funcNameOrFunc == RbxGuiLib.CreateSlider then
			return "Function CreateSlider.  " ..
				"Arguments: (steps, width, position) " ..
				"Side effect: returns 2 objects, (sliderGui, sliderPosition).  The 'steps' argument specifies how many different positions the slider can hold along the bar.  'width' specifies in pixels how wide the bar should be (modifiable afterwards if desired). 'position' argument should be a UDim2 for slider positioning. 'sliderPosition' is an IntValue whose current .Value specifies the specific step the slider is currently on."
		end
	end
-- RBXGUI END --

delay(0, function()

local function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end

local function waitForProperty(instance, property)
	while not instance[property] do
		instance.Changed:wait()
	end
end

-- A Few Script Globals
local gui
if game:GetService("CoreGui").RobloxGui:FindFirstChild("ControlFrame") then
	gui = game:GetService("CoreGui").RobloxGui:FindFirstChild("ControlFrame")
else
	gui = game:GetService("CoreGui").RobloxGui
end

local useOldDialog = false

local helpButton = nil
local updateCameraDropDownSelection = nil
local updateVideoCaptureDropDownSelection = nil
local tweenTime = 0.2

local mouseLockLookScreenUrl = "rbxasset://textures/ui/tutorial_look_lock.png"
local classicLookScreenUrl = "rbxasset://textures/ui/tutorial_look_classic.png"

local hasGraphicsSlider = false
local recordingVideo = false
local useNewGui = true

local newGuiPlaces = {0,41324860}

-- Hotkeys
local escKey = string.char(27)
local escPressed = false

-- We should probably have a better method to determine this...
local macClient = false
local isMacChat, version = pcall(function() return game.GuiService.Version end)
macClient = isMacChat and version >= 2

local function Color3I(r,g,b)
  return Color3.new(r/255,g/255,b/255)
end

local function robloxLock(instance)
  instance.RobloxLocked = true
  children = instance:GetChildren()
  if children then
	 for i, child in ipairs(children) do
		robloxLock(child)
	 end
  end
end

function resumeGameFunction(shield)
	shield.Settings:TweenPosition(UDim2.new(0.5, -262,-0.5, -200),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
	delay(tweenTime,function()
		shield.Visible = false
		pcall(function() game.GuiService:RemoveCenterDialog(shield) end)
		settingsButton.Active = true
	end)
end

function goToMenu(container,menuName, moveDirection)
	if type(menuName) ~= "string" then return end
	local containerChildren = container:GetChildren()
	for i = 1, #containerChildren do
		if containerChildren[i].Name == menuName then
			containerChildren[i].Visible = true
			containerChildren[i]:TweenPosition(UDim2.new(0,0,0,0),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
		else
			if moveDirection == "left" then
				containerChildren[i]:TweenPosition(UDim2.new(-1,-525,0,0),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
			elseif moveDirection == "right" then
				containerChildren[i]:TweenPosition(UDim2.new(1,525,0,0),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
			elseif moveDirection == "up" then
				containerChildren[i]:TweenPosition(UDim2.new(0,0,-1,-400),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
			elseif moveDirection == "down" then
				containerChildren[i]:TweenPosition(UDim2.new(0,0,1,400),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
			end
			delay(tweenTime,function()
				containerChildren[i].Visible = false
			end)
		end
	end	
end

function resetLocalCharacter()
	local player = game.Players.LocalPlayer
	if player then
		if player.Character and player.Character:FindFirstChild("Humanoid") then
			player.Character.Humanoid.Health = 0
		end
	end
end

local function createTextButton(text,style,fontSize,buttonSize,buttonPosition)
	local newTextButton = Instance.new("TextButton")
	newTextButton.Font = Enum.Font.Arial
	newTextButton.FontSize = fontSize
	newTextButton.Size = buttonSize
	newTextButton.Position = buttonPosition
	newTextButton.Style = style
	newTextButton.TextColor3 = Color3.new(1,1,1)
	newTextButton.Text = text
	return newTextButton
end

local function CreateTextButtons(frame, buttons, yPos, ySize)
	if #buttons < 1 then
		error("Must have more than one button")
	end

	local buttonNum = 1
	local buttonObjs = {}

	local function toggleSelection(button)
		for i, obj in ipairs(buttonObjs) do
			if obj == button then
				obj.Style = Enum.ButtonStyle.RobloxButtonDefault
			else
				obj.Style = Enum.ButtonStyle.RobloxButton
			end
		end
	end

	for i, obj in ipairs(buttons) do 
		local button = Instance.new("TextButton")
		button.Name = "Button" .. buttonNum
		button.Font = Enum.Font.Arial
		button.FontSize = Enum.FontSize.Size18
		button.AutoButtonColor = true
		button.Style = Enum.ButtonStyle.RobloxButton
		button.Text = obj.Text
		button.TextColor3 = Color3.new(1,1,1)
		button.MouseButton1Click:connect(function() toggleSelection(button) obj.Function() end)
		button.Parent = frame
		buttonObjs[buttonNum] = button

		buttonNum = buttonNum + 1
	end
	
	toggleSelection(buttonObjs[1])

	local numButtons = buttonNum-1

	if numButtons == 1 then
		frame.Button1.Position = UDim2.new(0.35, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.4,0,ySize.Scale, ySize.Offset)
	elseif numButtons == 2 then
		frame.Button1.Position = UDim2.new(0.1, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.35,0, ySize.Scale, ySize.Offset)

		frame.Button2.Position = UDim2.new(0.55, 0, yPos.Scale, yPos.Offset)
		frame.Button2.Size = UDim2.new(.35,0, ySize.Scale, ySize.Offset)
	elseif numButtons >= 3 then
		local spacing = .1 / numButtons
		local buttonSize = .9 / numButtons

		buttonNum = 1
		while buttonNum <= numButtons do
			buttonObjs[buttonNum].Position = UDim2.new(spacing*buttonNum + (buttonNum-1) * buttonSize, 0, yPos.Scale, yPos.Offset)
			buttonObjs[buttonNum].Size = UDim2.new(buttonSize, 0, ySize.Scale, ySize.Offset)
			buttonNum = buttonNum + 1
		end
	end
end

function recordVideoClick(recordVideoButton, stopRecordButton)
	recordingVideo = not recordingVideo
	if recordingVideo then
		stopRecordButton.Visible = true
		recordVideoButton.Text = "Stop Recording"
	else
		stopRecordButton.Visible = false
		recordVideoButton.Text = "Record Video"
	end
end

function backToGame(buttonClicked, shield, settingsButton)
	buttonClicked.Parent.Parent.Parent.Parent.Visible = false
	shield.Visible = false
	pcall(function() game.GuiService:RemoveCenterDialog(shield) end)
	settingsButton.Active = true
end

function setDisabledState(guiObject)
	if guiObject:IsA("TextLabel") then
		guiObject.TextTransparency = 0.9
	elseif guiObject:IsA("TextButton") then
		guiObject.TextTransparency = 0.9
		guiObject.Active = false
	else
		if guiObject["ClassName"] then
			print("setDisabledState() got object of unsupported type.  object type is ",guiObject.ClassName)
		end
	end
end

function showEnabledState(guiObject)
	if guiObject:IsA("TextLabel") then
		guiObject.TextTransparency = 0
	elseif guiObject:IsA("TextButton") then
		guiObject.TextTransparency = 0
		guiObject.Active = true
	else
		if guiObject["ClassName"] then
			print("showEnabledState() got object of unsupported type.  object type is ",guiObject.ClassName)
		end
	end
end


local function createHelpDialog(baseZIndex)

	if helpButton == nil then
		if gui:FindFirstChild("TopLeftControl") and gui.TopLeftControl:FindFirstChild("Help") then
			helpButton = gui.TopLeftControl.Help
		elseif gui:FindFirstChild("BottomRightControl") and gui.BottomRightControl:FindFirstChild("Help") then
			helpButton = gui.BottomRightControl.Help
		end
	end

	local shield = Instance.new("Frame")
	shield.Name = "HelpDialogShield"
	shield.Active = true
	shield.Visible = false
	shield.Size = UDim2.new(1,0,1,0)
	shield.BackgroundColor3 = Color3I(51,51,51)
	shield.BorderColor3 = Color3I(27,42,53)
	shield.BackgroundTransparency = 0.4
	shield.ZIndex = baseZIndex + 1

	local helpDialog = Instance.new("Frame")
	helpDialog.Name = "HelpDialog"
	helpDialog.Style = Enum.FrameStyle.RobloxRound
	helpDialog.Position = UDim2.new(.2, 0, .2, 0)
	helpDialog.Size = UDim2.new(0.6, 0, 0.6, 0)
	helpDialog.Active = true
	helpDialog.Parent = shield

	local titleLabel = Instance.new("TextLabel")
	titleLabel.Name = "Title"
	titleLabel.Text = "Keyboard & Mouse Controls"
	titleLabel.Font = Enum.Font.ArialBold
	titleLabel.FontSize = Enum.FontSize.Size36
	titleLabel.Position = UDim2.new(0, 0, 0.025, 0)
	titleLabel.Size = UDim2.new(1, 0, 0, 40)
	titleLabel.TextColor3 = Color3.new(1,1,1)
	titleLabel.BackgroundTransparency = 1
	titleLabel.Parent = helpDialog

	local buttonRow = Instance.new("Frame")
	buttonRow.Name = "Buttons"
	buttonRow.Position = UDim2.new(0.1, 0, .07, 40)
	buttonRow.Size = UDim2.new(0.8, 0, 0, 45)
	buttonRow.BackgroundTransparency = 1
	buttonRow.Parent = helpDialog

	local imageFrame = Instance.new("Frame")
	imageFrame.Name = "ImageFrame"
	imageFrame.Position = UDim2.new(0.05, 0, 0.075, 80)
	imageFrame.Size = UDim2.new(0.9, 0, .9, -120)
	imageFrame.BackgroundTransparency = 1
	imageFrame.Parent = helpDialog

	local layoutFrame = Instance.new("Frame")
	layoutFrame.Name = "LayoutFrame"
	layoutFrame.Position = UDim2.new(0.5, 0, 0, 0)
	layoutFrame.Size = UDim2.new(1.5, 0, 1, 0)
	layoutFrame.BackgroundTransparency = 1
	layoutFrame.SizeConstraint = Enum.SizeConstraint.RelativeYY
	layoutFrame.Parent = imageFrame

	local image = Instance.new("ImageLabel")
	image.Name = "Image"
	if UserSettings().GameSettings.ControlMode == Enum.ControlMode["Mouse Lock Switch"] then
		image.Image = mouseLockLookScreenUrl
	else
		image.Image = classicLookScreenUrl
	end
	image.Position = UDim2.new(-0.5, 0, 0, 0)
	image.Size = UDim2.new(1, 0, 1, 0)
	image.BackgroundTransparency = 1
	image.Parent = layoutFrame
	
	local buttons = {}
	buttons[1] = {}
	buttons[1].Text = "Look"
	buttons[1].Function = function()
		if UserSettings().GameSettings.ControlMode == Enum.ControlMode["Mouse Lock Switch"] then
			image.Image = mouseLockLookScreenUrl
		else
			image.Image = classicLookScreenUrl
		end
	end 
	buttons[2] = {}
	buttons[2].Text = "Move"
	buttons[2].Function = function() 
		image.Image = "rbxasset://textures/ui/tutorial_move.png"
	end 
	buttons[3] = {}
	buttons[3].Text = "Gear"
	buttons[3].Function = function() 
		image.Image = "rbxasset://textures/ui/tutorial_gear.png"
	end
	buttons[4] = {}
	buttons[4].Text = "Zoom"
	buttons[4].Function = function() 	
		image.Image = "rbxasset://textures/ui/tutorial_zoom.png"
	end 

	CreateTextButtons(buttonRow, buttons, UDim.new(0, 0), UDim.new(1,0))
	
		
	-- set up listeners for type of mouse mode, but keep constructing gui at same time
	delay(0, function()
		waitForChild(gui,"UserSettingsShield")
		waitForChild(gui.UserSettingsShield,"Settings")
		waitForChild(gui.UserSettingsShield.Settings,"SettingsStyle")
		waitForChild(gui.UserSettingsShield.Settings.SettingsStyle, "GameSettingsMenu")
		waitForChild(gui.UserSettingsShield.Settings.SettingsStyle.GameSettingsMenu, "CameraField")
		waitForChild(gui.UserSettingsShield.Settings.SettingsStyle.GameSettingsMenu.CameraField, "DropDownMenuButton")
		gui.UserSettingsShield.Settings.SettingsStyle.GameSettingsMenu.CameraField.DropDownMenuButton.Changed:connect(function(prop)
			if prop ~= "Text" then return end
			if buttonRow.Button1.Style == Enum.ButtonStyle.RobloxButtonDefault then -- only change if this is the currently selected panel
				if gui.UserSettingsShield.Settings.SettingsStyle.GameSettingsMenu.CameraField.DropDownMenuButton.Text == "Classic" then
					image.Image = classicLookScreenUrl
				else
					image.Image = mouseLockLookScreenUrl
				end
			end
		end)
	end)


	local okBtn = Instance.new("TextButton")
	okBtn.Name = "OkBtn"
	okBtn.Text = "OK"
	okBtn.Size = UDim2.new(0.3, 0, 0, 45)
	okBtn.Position = UDim2.new(0.35, 0, .975, -50)
	okBtn.Font = Enum.Font.Arial
	okBtn.FontSize = Enum.FontSize.Size18
	okBtn.BackgroundTransparency = 1
	okBtn.TextColor3 = Color3.new(1,1,1)
	okBtn.Style = Enum.ButtonStyle.RobloxButtonDefault
	okBtn.MouseButton1Click:connect(
		function()
			shield.Visible = false
			pcall(function() game.GuiService:RemoveCenterDialog(shield) end)
		end)
	okBtn.Parent = helpDialog

	robloxLock(shield)
	return shield
end

local function createLeaveConfirmationMenu(baseZIndex,shield)
	local frame = Instance.new("Frame")
	frame.Name = "LeaveConfirmationMenu"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(1,0,1,0)
	frame.Position = UDim2.new(0,0,2,400)
	frame.ZIndex = baseZIndex + 4
	
	local yesButton = createTextButton("Yes",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size24,UDim2.new(0,128,0,50),UDim2.new(0,313,0.8,0))
	yesButton.Name = "YesButton"
	yesButton.ZIndex = baseZIndex + 4
	yesButton.Parent = frame
	pcall(function() yesButton:SetVerb("Exit") end)
	
	local noButton = createTextButton("No",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size24,UDim2.new(0,128,0,50),UDim2.new(0,90,0.8,0))
	noButton.Name = "NoButton"
	noButton.Parent = frame
	noButton.ZIndex = baseZIndex + 4
	noButton.MouseButton1Click:connect(function()
		if escPressed then
			escPressed = false
		
			shield.Settings.SettingsStyle.Parent:TweenPosition(UDim2.new(0.5, -262,-0.5, -200),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
			shield.Settings.SettingsStyle.Parent:TweenSize(UDim2.new(0,525,0,430),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
			shield.Visible = false
			game.CoreGui.RobloxGui.ControlFrame.BottomLeftControl.SettingsButton.Active = true
		else
			goToMenu(shield.Settings.SettingsStyle,"GameMainMenu","down")
			shield.Settings:TweenSize(UDim2.new(0,525,0,430),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
		end
	end)
	
	local leaveText = Instance.new("TextLabel")
	leaveText.Name = "LeaveText"
	leaveText.Text = "Are you sure you want to leave this game?"
	leaveText.Size = UDim2.new(1,0,0.8,0)
	leaveText.TextWrap = true
	leaveText.TextColor3 = Color3.new(1,1,1)
	leaveText.Font = Enum.Font.ArialBold
	leaveText.FontSize = Enum.FontSize.Size36
	leaveText.BackgroundTransparency = 1
	leaveText.ZIndex = baseZIndex + 4
	leaveText.Parent = frame
	
	return frame
end

local function createResetConfirmationMenu(baseZIndex,shield)
	local frame = Instance.new("Frame")
	frame.Name = "ResetConfirmationMenu"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(1,0,1,0)
	frame.Position = UDim2.new(0,0,2,400)
	frame.ZIndex = baseZIndex + 4
	
	local yesButton = createTextButton("Yes",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size24,UDim2.new(0,128,0,50),UDim2.new(0,313,0,299))
	yesButton.Name = "YesButton"
	yesButton.ZIndex = baseZIndex + 4
	yesButton.Parent = frame
	yesButton.MouseButton1Click:connect(function()
		resumeGameFunction(shield)
		resetLocalCharacter()
	end)
	
	local noButton = createTextButton("No",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size24,UDim2.new(0,128,0,50),UDim2.new(0,90,0,299))
	noButton.Name = "NoButton"
	noButton.Parent = frame
	noButton.ZIndex = baseZIndex + 4
	noButton.MouseButton1Click:connect(function()
		goToMenu(shield.Settings.SettingsStyle,"GameMainMenu","down")
		shield.Settings:TweenSize(UDim2.new(0,525,0,430),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
	end)
	
	local resetCharacterText = Instance.new("TextLabel")
	resetCharacterText.Name = "ResetCharacterText"
	resetCharacterText.Text = "Are you sure you want to reset your character?"
	resetCharacterText.Size = UDim2.new(1,0,0.8,0)
	resetCharacterText.TextWrap = true
	resetCharacterText.TextColor3 = Color3.new(1,1,1)
	resetCharacterText.Font = Enum.Font.ArialBold
	resetCharacterText.FontSize = Enum.FontSize.Size36
	resetCharacterText.BackgroundTransparency = 1
	resetCharacterText.ZIndex = baseZIndex + 4
	resetCharacterText.Parent = frame
	
	local fineResetCharacterText = resetCharacterText:Clone()
	fineResetCharacterText.Name = "FineResetCharacterText"
	fineResetCharacterText.Text = "You will be put back on a spawn point"
	fineResetCharacterText.Size = UDim2.new(0,303,0,18)
	fineResetCharacterText.Position = UDim2.new(0, 109, 0, 215)
	fineResetCharacterText.FontSize = Enum.FontSize.Size18
	fineResetCharacterText.Parent = frame
	
	return frame
end

local function createGameMainMenu(baseZIndex, shield)
	local gameMainMenuFrame = Instance.new("Frame")
	gameMainMenuFrame.Name = "GameMainMenu"
	gameMainMenuFrame.BackgroundTransparency = 1
	gameMainMenuFrame.Size = UDim2.new(1,0,1,0)
	gameMainMenuFrame.ZIndex = baseZIndex + 4
	gameMainMenuFrame.Parent = settingsFrame

	-- GameMainMenu Children
	
	local gameMainMenuTitle = Instance.new("TextLabel")
	gameMainMenuTitle.Name = "Title"
	gameMainMenuTitle.Text = "Game Menu"
	gameMainMenuTitle.BackgroundTransparency = 1
	gameMainMenuTitle.Font = Enum.Font.ArialBold
	gameMainMenuTitle.FontSize = Enum.FontSize.Size36
	gameMainMenuTitle.Size = UDim2.new(1,0,0,36)
	gameMainMenuTitle.Position = UDim2.new(0,0,0,4)
	gameMainMenuTitle.TextColor3 = Color3.new(1,1,1)
	gameMainMenuTitle.ZIndex = baseZIndex + 4
	gameMainMenuTitle.Parent = gameMainMenuFrame
	
	local robloxHelpButton = createTextButton("Help",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size18,UDim2.new(0,164,0,50),UDim2.new(0,82,0,239))
	robloxHelpButton.Name = "HelpButton"
	robloxHelpButton.ZIndex = baseZIndex + 4
	robloxHelpButton.Parent = gameMainMenuFrame
	if useNewGui then
		helpButton = robloxHelpButton
	else
		robloxHelpButton.Visible = false
	end
			
	local helpDialog = createHelpDialog(baseZIndex)
	helpDialog.Parent = gui
		
	helpButton.MouseButton1Click:connect(
		function() 
			local centerDialogSuccess = pcall(function() game.GuiService:AddCenterDialog(helpDialog, Enum.CenterDialogType.ModalDialog,
				--ShowFunction
				function()
					helpDialog.Visible = true 
				end,
				--HideFunction
				function()
					helpDialog.Visible = false
				end)
			end)
			if centerDialogSuccess == false then
				helpDialog.Visible = true 
			end
		end)
	helpButton.Active = true
	
	local helpShortcut = Instance.new("TextLabel")
	helpShortcut.Name = "HelpShortcutText"
	helpShortcut.Text = "F1"
	helpShortcut.Visible = false
	helpShortcut.BackgroundTransparency = 1
	helpShortcut.Font = Enum.Font.Arial
	helpShortcut.FontSize = Enum.FontSize.Size12
	helpShortcut.Position = UDim2.new(0,85,0,0)
	helpShortcut.Size = UDim2.new(0,30,0,30)
	helpShortcut.TextColor3 = Color3.new(0,1,0)
	helpShortcut.ZIndex = baseZIndex + 4
	helpShortcut.Parent = robloxHelpButton
	
	local screenshotButton = createTextButton("Screenshot",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size18,UDim2.new(0,168,0,50),UDim2.new(0,254,0,239))
	screenshotButton.Name = "ScreenshotButton"
	screenshotButton.ZIndex = baseZIndex + 4
	screenshotButton.Parent = gameMainMenuFrame
	screenshotButton.Visible = not macClient
	pcall(function() screenshotButton:SetVerb("Screenshot") end)
	
	local screenshotShortcut = helpShortcut:clone()
	screenshotShortcut.Name = "ScreenshotShortcutText"
	screenshotShortcut.Text = "PrintSc"
	screenshotShortcut.Position = UDim2.new(0,118,0,0)
	screenshotShortcut.Visible = true
	screenshotShortcut.Parent = screenshotButton
	
	
	local recordVideoButton = createTextButton("Record Video",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size18,UDim2.new(0,168,0,50),UDim2.new(0,254,0,290))
	recordVideoButton.Name = "RecordVideoButton"
	recordVideoButton.ZIndex = baseZIndex + 4
	recordVideoButton.Parent = gameMainMenuFrame
	recordVideoButton.Visible = not macClient
	local supportVideoCapture = pcall(function() return UserSettings().GameSettings.VideoUploadPromptBehavior end)
	if supportVideoCapture then
		pcall(function() recordVideoButton:SetVerb("RecordToggle") end)
	end
	
	local recordVideoShortcut = helpShortcut:clone()
	recordVideoShortcut.Name = "RecordVideoShortcutText"
	recordVideoShortcut.Text = "F12"
	recordVideoShortcut.Position = UDim2.new(0,120,0,0)
	recordVideoShortcut.Parent = recordVideoButton
	
	local stopRecordButton = Instance.new("ImageButton")
	stopRecordButton.Name = "StopRecordButton"
	stopRecordButton.BackgroundTransparency = 1
	stopRecordButton.Image = "rbxasset://textures/ui/RecordStop.png"
	stopRecordButton.Size = UDim2.new(0,59,0,27)
	if supportVideoCapture then
		pcall(function() stopRecordButton:SetVerb("RecordToggle") end)
	end
	stopRecordButton.MouseButton1Click:connect(function() recordVideoClick(recordVideoButton, stopRecordButton) end)
	stopRecordButton.Visible = false
	stopRecordButton.Parent = gui
	
	local reportAbuseButton = createTextButton("Report Abuse",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size18,UDim2.new(0,164,0,50),UDim2.new(0,82,0,290))
	reportAbuseButton.Name = "ReportAbuseButton"
	reportAbuseButton.ZIndex = baseZIndex + 4
	reportAbuseButton.Parent = gameMainMenuFrame
	
	local leaveGameButton = createTextButton("Leave Game",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size24,UDim2.new(0,340,0,50),UDim2.new(0,82,0,358))
	leaveGameButton.Name = "LeaveGameButton"
	leaveGameButton.ZIndex = baseZIndex + 4
	leaveGameButton.Parent = gameMainMenuFrame
	
	local resumeGameButton = createTextButton("Resume Game",Enum.ButtonStyle.RobloxButtonDefault,Enum.FontSize.Size24,UDim2.new(0,340,0,50),UDim2.new(0,82,0,54))
	resumeGameButton.Name = "resumeGameButton"
	resumeGameButton.ZIndex = baseZIndex + 4
	resumeGameButton.Parent = gameMainMenuFrame
	resumeGameButton.MouseButton1Click:connect(function() resumeGameFunction(shield) end)
	
	local gameSettingsButton = createTextButton("Game Settings",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size24,UDim2.new(0,340,0,50),UDim2.new(0,82,0,172))
	gameSettingsButton.Name = "SettingsButton"
	gameSettingsButton.ZIndex = baseZIndex + 4
	gameSettingsButton.Parent = gameMainMenuFrame
	
	local resetButton = createTextButton("Reset Character",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size24,UDim2.new(0,340,0,50),UDim2.new(0,82,0,105))
	resetButton.Name = "ResetButton"
	resetButton.ZIndex = baseZIndex + 4
	resetButton.Parent = gameMainMenuFrame
	
	return gameMainMenuFrame
end

local function createGameSettingsMenu(baseZIndex, shield)
	local gameSettingsMenuFrame = Instance.new("Frame")
	gameSettingsMenuFrame.Name = "GameSettingsMenu"
	gameSettingsMenuFrame.BackgroundTransparency = 1
	gameSettingsMenuFrame.Size = UDim2.new(1,0,1,0)
	gameSettingsMenuFrame.ZIndex = baseZIndex + 4
	
	local title = Instance.new("TextLabel")
	title.Name = "Title"
	title.Text = "Settings"
	title.Size = UDim2.new(1,0,0,48)
	title.Position = UDim2.new(0,9,0,-9)
	title.Font = Enum.Font.ArialBold
	title.FontSize = Enum.FontSize.Size36
	title.TextColor3 = Color3.new(1,1,1)
	title.ZIndex = baseZIndex + 4
	title.BackgroundTransparency = 1
	title.Parent = gameSettingsMenuFrame
	
	local fullscreenText = Instance.new("TextLabel")
	fullscreenText.Name = "FullscreenText"
	fullscreenText.Text = "Fullscreen Mode"
	fullscreenText.Size = UDim2.new(0,124,0,18)
	fullscreenText.Position = UDim2.new(0,62,0,145)
	fullscreenText.Font = Enum.Font.Arial
	fullscreenText.FontSize = Enum.FontSize.Size18
	fullscreenText.TextColor3 = Color3.new(1,1,1)
	fullscreenText.ZIndex = baseZIndex + 4
	fullscreenText.BackgroundTransparency = 1
	fullscreenText.Parent = gameSettingsMenuFrame
	
	local fullscreenShortcut = Instance.new("TextLabel")
	fullscreenShortcut.Visible = false
	fullscreenShortcut.Name = "FullscreenShortcutText"
	fullscreenShortcut.Text = "F11"
	fullscreenShortcut.BackgroundTransparency = 1
	fullscreenShortcut.Font = Enum.Font.Arial
	fullscreenShortcut.FontSize = Enum.FontSize.Size12
	fullscreenShortcut.Position = UDim2.new(0,186,0,141)
	fullscreenShortcut.Size = UDim2.new(0,30,0,30)
	fullscreenShortcut.TextColor3 = Color3.new(0,1,0)
	fullscreenShortcut.ZIndex = baseZIndex + 4
	fullscreenShortcut.Parent = gameSettingsMenuFrame
	
	local studioText = Instance.new("TextLabel")
	studioText.Name = "StudioText"
	studioText.Text = "Studio Mode"
	studioText.Size = UDim2.new(0,95,0,18)
	studioText.Position = UDim2.new(0,62,0,179)
	studioText.Font = Enum.Font.Arial
	studioText.FontSize = Enum.FontSize.Size18
	studioText.TextColor3 = Color3.new(1,1,1)
	studioText.ZIndex = baseZIndex + 4
	studioText.BackgroundTransparency = 1
	studioText.Parent = gameSettingsMenuFrame
	
	local studioShortcut = fullscreenShortcut:clone()
	studioShortcut.Name = "StudioShortcutText"
	studioShortcut.Text = "F2"
	studioShortcut.Position = UDim2.new(0,154,0,175)
	studioShortcut.Parent = gameSettingsMenuFrame
	
	if hasGraphicsSlider then
		local qualityText = Instance.new("TextLabel")
		qualityText.Name = "QualityText"
		qualityText.Text = "Graphics Quality"
		qualityText.Size = UDim2.new(0,128,0,18)
		qualityText.Position = UDim2.new(0,31,0,226)
		qualityText.Font = Enum.Font.Arial
		qualityText.FontSize = Enum.FontSize.Size18
		qualityText.TextColor3 = Color3.new(1,1,1)
		qualityText.ZIndex = baseZIndex + 4
		qualityText.BackgroundTransparency = 1
		qualityText.Parent = gameSettingsMenuFrame
		
		local graphicsSlider, graphicsLevel = RbxGui.CreateSlider(10,200,UDim2.new(0, 270, 0, 232))
		graphicsSlider.Parent = gameSettingsMenuFrame
		graphicsSlider.Bar.ZIndex = baseZIndex + 4
		graphicsSlider.Bar.Slider.ZIndex = baseZIndex + 5
	end
	
	local fullscreenCheckbox = createTextButton("",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size18,UDim2.new(0,25,0,25),UDim2.new(0,30,0,144))
	fullscreenCheckbox.Name = "FullscreenCheckbox"
	fullscreenCheckbox.ZIndex = baseZIndex + 4
	fullscreenCheckbox.Parent = gameSettingsMenuFrame
	pcall(function()
		if UserSettings().GameSettings:InFullScreen() then
			fullscreenCheckbox.Text = "X"
		end
	end)
	fullscreenCheckbox.MouseButton1Click:connect(function()
		if fullscreenCheckbox.Text == "" then
			fullscreenCheckbox.Text = "X"
		else
			fullscreenCheckbox.Text = ""
		end
	end)
	pcall(function() fullscreenCheckbox:SetVerb("ToggleFullScreen") end)
	
	local studioCheckbox = createTextButton("",Enum.ButtonStyle.RobloxButton,Enum.FontSize.Size18,UDim2.new(0,25,0,25),UDim2.new(0,30,0,176))
	studioCheckbox.Name = "StudioCheckbox"
	studioCheckbox.ZIndex = baseZIndex + 4
	studioCheckbox.Parent = gameSettingsMenuFrame
	pcall(function()
		if UserSettings().GameSettings:InStudioMode() then
			studioCheckbox.Text = "X"
		end
	end)
	studioCheckbox.MouseButton1Click:connect(function()
		if not studioCheckbox.Active then return end
		
		if studioCheckbox.Text == "" then
			studioCheckbox.Text = "X"
		else
			studioCheckbox.Text = ""
		end
	end)
	pcall(function() studioCheckbox:SetVerb("TogglePlayMode") end)
	
	if game:FindFirstChild("NetworkClient") then -- we are playing online
		setDisabledState(studioText)
		setDisabledState(studioShortcut)
		setDisabledState(studioCheckbox)
	end
	
	local backButton = createTextButton("OK",Enum.ButtonStyle.RobloxButtonDefault,Enum.FontSize.Size24,UDim2.new(0,180,0,50),UDim2.new(0,170,0,270))
	backButton.Name = "BackButton"
	backButton.ZIndex = baseZIndex + 4
	backButton.Parent = gameSettingsMenuFrame
	
	local syncVideoCaptureSetting = nil

	local supportVideoCapture = pcall(function() return UserSettings().GameSettings.VideoUploadPromptBehavior end)
	if supportVideoCapture and not macClient then
		local videoCaptureLabel = Instance.new("TextLabel")
		videoCaptureLabel.Name = "VideoCaptureLabel"
		videoCaptureLabel.Text = "After Capturing Video"
		videoCaptureLabel.Font = Enum.Font.Arial
		videoCaptureLabel.FontSize = Enum.FontSize.Size18
		videoCaptureLabel.Position = UDim2.new(0,32,0,100)
		videoCaptureLabel.Size = UDim2.new(0,164,0,18)
		videoCaptureLabel.BackgroundTransparency = 1
		videoCaptureLabel.TextColor3 = Color3I(255,255,255)
		videoCaptureLabel.TextXAlignment = Enum.TextXAlignment.Left
		videoCaptureLabel.ZIndex = baseZIndex + 4
		videoCaptureLabel.Parent = gameSettingsMenuFrame

		local videoNames = {}
		local videoNameToItem = {}
		videoNames[1] = "Just Save to Disk"
		videoNameToItem[videoNames[1]] = Enum.UploadSetting["Never"]
		videoNames[2] = "Upload to YouTube"
		videoNameToItem[videoNames[2]] = Enum.UploadSetting["Ask me first"]

		local videoCaptureDropDown = nil
		videoCaptureDropDown, updateVideoCaptureDropDownSelection = RbxGui.CreateDropDownMenu(videoNames, 
			function(text) 
				UserSettings().GameSettings.VideoUploadPromptBehavior = videoNameToItem[text]
			end)
		videoCaptureDropDown.Name = "VideoCaptureField"
		videoCaptureDropDown.ZIndex = baseZIndex + 4
		videoCaptureDropDown.DropDownMenuButton.ZIndex = baseZIndex + 4
		videoCaptureDropDown.DropDownMenuButton.Icon.ZIndex = baseZIndex + 4
		videoCaptureDropDown.Position = UDim2.new(0, 270, 0, 94)
		videoCaptureDropDown.Size = UDim2.new(0,200,0,32)
		videoCaptureDropDown.Parent = gameSettingsMenuFrame

		syncVideoCaptureSetting = function()
			if UserSettings().GameSettings.VideoUploadPromptBehavior == Enum.UploadSetting["Never"] then
				updateVideoCaptureDropDownSelection(videoNames[1])
			elseif UserSettings().GameSettings.VideoUploadPromptBehavior == Enum.UploadSetting["Ask me first"] then
				updateVideoCaptureDropDownSelection(videoNames[2])
			else
				UserSettings().GameSettings.VideoUploadPromptBehavior = Enum.UploadSetting["Ask me first"]
				updateVideoCaptureDropDownSelection(videoNames[2])
			end
		end
	end
	
	local cameraLabel = Instance.new("TextLabel")
	cameraLabel.Name = "CameraLabel"
	cameraLabel.Text = "Character & Camera Controls"
	cameraLabel.Font = Enum.Font.Arial
	cameraLabel.FontSize = Enum.FontSize.Size18
	cameraLabel.Position = UDim2.new(0,31,0,58)
	cameraLabel.Size = UDim2.new(0,224,0,18)
	cameraLabel.TextColor3 = Color3I(255,255,255)
	cameraLabel.TextXAlignment = Enum.TextXAlignment.Left
	cameraLabel.BackgroundTransparency = 1
	cameraLabel.ZIndex = baseZIndex + 4
	cameraLabel.Parent = gameSettingsMenuFrame

	local mouseLockLabel = game.CoreGui.RobloxGui:FindFirstChild("MouseLockLabel",true)

	local enumItems = Enum.ControlMode:GetEnumItems()
	local enumNames = {}
	local enumNameToItem = {}
	for i,obj in ipairs(enumItems) do
		enumNames[i] = obj.Name
		enumNameToItem[obj.Name] = obj
	end

	local cameraDropDown
	cameraDropDown, updateCameraDropDownSelection = RbxGui.CreateDropDownMenu(enumNames, 
		function(text) 
			UserSettings().GameSettings.ControlMode = enumNameToItem[text] 
			
			pcall(function()
				if mouseLockLabel and UserSettings().GameSettings.ControlMode == Enum.ControlMode["Mouse Lock Switch"] then
					mouseLockLabel.Visible = true
				elseif mouseLockLabel then
					mouseLockLabel.Visible = false
				end
			end)
		end)
	cameraDropDown.Name = "CameraField"
	cameraDropDown.ZIndex = baseZIndex + 4
	cameraDropDown.DropDownMenuButton.ZIndex = baseZIndex + 4
	cameraDropDown.DropDownMenuButton.Icon.ZIndex = baseZIndex + 4
	cameraDropDown.Position = UDim2.new(0, 270, 0, 52)
	cameraDropDown.Size = UDim2.new(0,200,0,32)
	cameraDropDown.Parent = gameSettingsMenuFrame
	
	return gameSettingsMenuFrame
end

if LoadLibrary then
  RbxGui = RbxGuiLib
  local baseZIndex = 0
if UserSettings then

		local createOldSettingsDialog = function()

			waitForChild(gui,"BottomLeftControl")
			settingsButton = gui.BottomLeftControl:FindFirstChild("SettingsButton")
		
			if settingsButton == nil then
				settingsButton = Instance.new("ImageButton")
				settingsButton.Name = "SettingsButton"
				settingsButton.BackgroundTransparency = 1
				settingsButton.Active = false
				settingsButton.Size = UDim2.new(0,54,0,46)
				settingsButton.Position = UDim2.new(0,2,0,50)
				settingsButton.Parent = gui.BottomLeftControl
				
				settingsButton.Image =  "rbxasset://textures/ui/SettingButtonOld.png"
				settingsButton.Size = UDim2.new(0,33,0,33)
				settingsButton.Position = UDim2.new(0, 128, 0.5, -17)
				settingsButton.MouseEnter:connect(function()
					settingsButton.Image = "rbxasset://textures/ui/SettingButtonOldEnter.png"
				end)
				settingsButton.MouseLeave:connect(function()
					settingsButton.Image =  "rbxasset://textures/ui/SettingButtonOld.png"
				end)
			end

			local shield = Instance.new("TextButton")
			shield.Text = ""
			shield.Name = "UserSettingsShield"
			shield.Active = true
			shield.AutoButtonColor = false
			shield.Visible = false
			shield.Size = UDim2.new(1,0,1,0)
			shield.BackgroundColor3 = Color3I(51,51,51)
			shield.BorderColor3 = Color3I(27,42,53)
			shield.BackgroundTransparency = 0.4
			shield.ZIndex = baseZIndex + 1

			local frame = Instance.new("Frame")
			frame.Name = "Settings"
			frame.Position = UDim2.new(0.5, -262, 0.5, -150)
			frame.Size = UDim2.new(0, 525, 0, 290)
			frame.BackgroundTransparency = 1
			frame.Active = true
			frame.Parent = shield

			local settingsFrame = Instance.new("Frame")
			settingsFrame.Name = "SettingsStyle"
			settingsFrame.Size = UDim2.new(1, 0, 1, 0)
			settingsFrame.Style = Enum.FrameStyle.RobloxRound
			settingsFrame.Active = true
			settingsFrame.ZIndex = baseZIndex + 1
			settingsFrame.Parent = frame

			local title = Instance.new("TextLabel")
			title.Name = "Title"
			title.Text = "Settings"
			title.TextColor3 = Color3I(221,221,221)
			title.Position = UDim2.new(0.5, 0, 0, 30)
			title.Font = Enum.Font.ArialBold
			title.FontSize = Enum.FontSize.Size36
			title.ZIndex = baseZIndex + 1
			title.Parent = settingsFrame

			local cameraLabel = Instance.new("TextLabel")
			cameraLabel.Name = "CameraLabel"
			cameraLabel.Text = "Character & Camera Controls:"
			cameraLabel.Font = Enum.Font.Arial
			cameraLabel.FontSize = Enum.FontSize.Size18
			cameraLabel.Position = UDim2.new(0,20,0,105)
			cameraLabel.TextColor3 = Color3I(255,255,255)
			cameraLabel.TextXAlignment = Enum.TextXAlignment.Left
			cameraLabel.ZIndex = baseZIndex + 1
			cameraLabel.Parent = settingsFrame

			local mouseLockLabel = game.CoreGui.RobloxGui:FindFirstChild("MouseLockLabel",true)

			local enumItems = Enum.ControlMode:GetEnumItems()
			local enumNames = {}
			local enumNameToItem = {}
			for i,obj in ipairs(enumItems) do
				enumNames[i] = obj.Name
				enumNameToItem[obj.Name] = obj
			end

			local cameraDropDown
			local updateCameraDropDownSelection
			cameraDropDown, updateCameraDropDownSelection = RbxGui.CreateDropDownMenu(enumNames, 
				function(text) 
					UserSettings().GameSettings.ControlMode = enumNameToItem[text] 
					
					pcall(function()
						if mouseLockLabel and UserSettings().GameSettings.ControlMode == Enum.ControlMode["Mouse Lock Switch"] then
							mouseLockLabel.Visible = true
						elseif mouseLockLabel then
							mouseLockLabel.Visible = false
						end
					end)
				end)
			cameraDropDown.Name = "CameraField"
			cameraDropDown.ZIndex = baseZIndex + 1
			cameraDropDown.Position = UDim2.new(0, 300, 0, 88)
			cameraDropDown.Size = UDim2.new(0,200,0,32)
			cameraDropDown.Parent = settingsFrame
			
			local syncVideoCaptureSetting = nil

			local supportVideoCapture = pcall(function() return UserSettings().GameSettings.VideoUploadPromptBehavior end)
			if supportVideoCapture then
				local videoCaptureLabel = Instance.new("TextLabel")
				videoCaptureLabel.Name = "VideoCaptureLabel"
				videoCaptureLabel.Text = "After Capturing Video:"
				videoCaptureLabel.Font = Enum.Font.Arial
				videoCaptureLabel.FontSize = Enum.FontSize.Size18
				videoCaptureLabel.Position = UDim2.new(0,20,0,145)
				videoCaptureLabel.TextColor3 = Color3I(255,255,255)
				videoCaptureLabel.TextXAlignment = Enum.TextXAlignment.Left
				videoCaptureLabel.ZIndex = baseZIndex + 1
				videoCaptureLabel.Parent = settingsFrame

				local videoNames = {}
				local videoNameToItem = {}
				videoNames[1] = "Just Save to Disk"
				videoNameToItem[videoNames[1]] = Enum.UploadSetting["Never"]
				videoNames[2] = "Upload to YouTube"
				videoNameToItem[videoNames[2]] = Enum.UploadSetting["Ask me first"]

				local videoCaptureDropDown, updateVideoCaptureDropDownSelection = RbxGui.CreateDropDownMenu(videoNames, 
					function(text) 
						UserSettings().GameSettings.VideoUploadPromptBehavior = videoNameToItem[text]
					end)
				videoCaptureDropDown.Name = "VideoCaptureField"
				videoCaptureDropDown.ZIndex = baseZIndex + 1
				videoCaptureDropDown.Position = UDim2.new(0, 300, 0, 128)
				videoCaptureDropDown.Size = UDim2.new(0,200,0,32)
				videoCaptureDropDown.Parent = settingsFrame

				syncVideoCaptureSetting = function()
					if gui:FindFirstChild("BottomRightControl") and gui.BottomRightControl:FindFirstChild("RecordToggle") then
						videoCaptureLabel.Visible = true
						videoCaptureDropDown.Visible = true
					if UserSettings().GameSettings.VideoUploadPromptBehavior == Enum.UploadSetting["Never"] then
						updateVideoCaptureDropDownSelection(videoNames[1])
					elseif UserSettings().GameSettings.VideoUploadPromptBehavior == Enum.UploadSetting["Ask me first"] then
						updateVideoCaptureDropDownSelection(videoNames[2])
					else
						UserSettings().GameSettings.VideoUploadPromptBehavior = Enum.UploadSetting["Ask me first"]
						updateVideoCaptureDropDownSelection(videoNames[2])
					end
					else
						videoCaptureLabel.Visible = false
						videoCaptureDropDown.Visible = false
					end
				end
			end
		
			local exitButton = Instance.new("TextButton")
			exitButton.Name = "ExitBtn"
			exitButton.Font = Enum.Font.Arial
			exitButton.FontSize = Enum.FontSize.Size18
			exitButton.Position = UDim2.new(0.5, -100, 0, 200)
			exitButton.Size = UDim2.new(0,200,0,50)
			exitButton.AutoButtonColor = true
			exitButton.Style = Enum.ButtonStyle.RobloxButtonDefault 
			exitButton.Text = "OK"
			exitButton.TextColor3 = Color3I(255,255,255)
			exitButton.ZIndex = baseZIndex + 1

			exitButton.Parent = settingsFrame

			robloxLock(shield)

			exitButton.MouseButton1Click:connect(
				function() 
					shield.Visible = false
					pcall(function() game.GuiService:RemoveCenterDialog(shield) end)
					settingsButton.Active = true				
				end
			)
			
			settingsButton.MouseButton1Click:connect(
				function()
					local centerDialogSuccess = pcall(function() game.GuiService:AddCenterDialog(shield, Enum.CenterDialogType.ModalDialog,
						--showFunction
						function()
							settingsButton.Active = false
							updateCameraDropDownSelection(UserSettings().GameSettings.ControlMode.Name)
						
							if syncVideoCaptureSetting then
  								syncVideoCaptureSetting()
							end

							shield.Visible = true
						end,
						--hideFunction
						function()
							shield.Visible = false
							settingsButton.Active = true
						end
						) 
					end) 
					
					if centerDialogSuccess == false then
  						settingsButton.Active = false
						updateCameraDropDownSelection(UserSettings().GameSettings.ControlMode.Name)
					
						if syncVideoCaptureSetting then
  							syncVideoCaptureSetting()
						end

						shield.Visible = true
					end
				end
			)	
			return shield
	end
	
	local createSettingsDialog = function()
		waitForChild(gui,"BottomLeftControl")
		settingsButton = gui.BottomLeftControl:FindFirstChild("SettingsButton")
		
		if settingsButton == nil then
			settingsButton = Instance.new("ImageButton")
			settingsButton.Name = "SettingsButton"
			settingsButton.Image = "rbxasset://textures/ui/SettingsButton.png"
			settingsButton.BackgroundTransparency = 1
			settingsButton.Active = false
			settingsButton.Size = UDim2.new(0,54,0,46)
			settingsButton.Position = UDim2.new(0,2,0,50)
			settingsButton.Parent = gui.BottomLeftControl
		end
		
				
		if not useNewGui then
			settingsButton.Image =  "rbxasset://textures/ui/SettingButtonOld.png"
			settingsButton.Size = UDim2.new(0,33,0,33)
			settingsButton.Position = UDim2.new(0, 128, 0.5, -17)
			settingsButton.MouseEnter:connect(function()
				settingsButton.Image = "rbxasset://textures/ui/SettingButtonOldEnter.png"
			end)
			settingsButton.MouseLeave:connect(function()
				settingsButton.Image =  "rbxasset://textures/ui/SettingButtonOld.png"
			end)
		end

		local shield = Instance.new("TextButton")
		shield.Text = ""
		shield.Name = "UserSettingsShield"
		shield.Active = true
		shield.AutoButtonColor = false
		shield.Visible = false
		shield.Size = UDim2.new(1,0,1,0)
		shield.BackgroundColor3 = Color3I(51,51,51)
		shield.BorderColor3 = Color3I(27,42,53)
		shield.BackgroundTransparency = 0.4
		shield.ZIndex = baseZIndex + 2

		local frame = Instance.new("Frame")
		frame.Name = "Settings"
		frame.Position = UDim2.new(0.5, -262, -0.5, -200)
		frame.Size = UDim2.new(0, 525, 0, 430)
		frame.BackgroundTransparency = 1
		frame.Active = true
		frame.Parent = shield

		local settingsFrame = Instance.new("Frame")
		settingsFrame.Name = "SettingsStyle"
		settingsFrame.Size = UDim2.new(1, 0, 1, 0)
		settingsFrame.Style = Enum.FrameStyle.RobloxRound
		settingsFrame.Active = true
		settingsFrame.ZIndex = baseZIndex + 3
		settingsFrame.Parent = frame
		
		local gameMainMenu = createGameMainMenu(baseZIndex, shield)
		gameMainMenu.Parent = settingsFrame
		
		gameMainMenu.ScreenshotButton.MouseButton1Click:connect(function()
			backToGame(gameMainMenu.ScreenshotButton, shield, settingsButton)	
		end)
			
		gameMainMenu.RecordVideoButton.MouseButton1Click:connect(function()
			recordVideoClick(gameMainMenu.RecordVideoButton, gui.StopRecordButton)
			backToGame(gameMainMenu.RecordVideoButton, shield, settingsButton)
		end)
	
		if not useNewGui then
			pcall(function()
				gui.BottomRightControl.RecordToggle.MouseButton1Click:connect(function()
					recordVideoClick(gameMainMenu.RecordVideoButton, gui.StopRecordButton)
				end)
			end)
		end
		
		game.CoreGui.RobloxGui.Changed:connect(function(prop) -- We have stopped recording when we resize
			if prop == "AbsoluteSize" and recordingVideo then
				recordVideoClick(gameMainMenu.RecordVideoButton, gui.StopRecordButton)
			end
		end)
		
		gameMainMenu.ResetButton.Visible = game.Players.LocalPlayer
		if game.Players.LocalPlayer ~= nil then
			game.Players.LocalPlayer.Changed:connect(function()
				gameMainMenu.ResetButton.Visible = game.Players.LocalPlayer
			end)
		else
			delay(0,function()
				waitForProperty(game.Players,"LocalPlayer")
				gameMainMenu.ResetButton.Visible = game.Players.LocalPlayer
				game.Players.LocalPlayer.Changed:connect(function()
					gameMainMenu.ResetButton.Visible = game.Players.LocalPlayer
				end)
			end)
		end
		
		gameMainMenu.ReportAbuseButton.Visible = game:FindFirstChild("NetworkClient")
		if not gameMainMenu.ReportAbuseButton.Visible then
			game.ChildAdded:connect(function(child)
				if child:IsA("NetworkClient") then
					gameMainMenu.ReportAbuseButton.Visible = game:FindFirstChild("NetworkClient")
				end
			end)
		end
		
		gameMainMenu.ResetButton.MouseButton1Click:connect(function()
			goToMenu(settingsFrame,"ResetConfirmationMenu","up")
			settingsFrame.Parent:TweenSize(UDim2.new(0,525,0,370),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
		end)
		
		gameMainMenu.LeaveGameButton.MouseButton1Click:connect(function()
			goToMenu(settingsFrame,"LeaveConfirmationMenu","down")
			settingsFrame.Parent:TweenSize(UDim2.new(0,525,0,300),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
		end)
		
		-- add in hotkey for leaving game
		--game:GetService("GuiService"):AddKey(escKey)
		game:GetService("GuiService").KeyPressed:connect(function(key)
			if key == escKey then
				--[[escPressed = true
				goToMenu(settingsFrame,"LeaveConfirmationMenu","down")
				shield.Visible = true
				settingsButton.Active = false
				settingsFrame.Parent:TweenPosition(UDim2.new(0.5, -262,0.5, -200),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
				settingsFrame.Parent:TweenSize(UDim2.new(0,525,0,430),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)]]
			end
		end)
			
		local gameSettingsMenu = createGameSettingsMenu(baseZIndex, shield)
		gameSettingsMenu.Visible = false
		gameSettingsMenu.Parent = settingsFrame
		
		gameMainMenu.SettingsButton.MouseButton1Click:connect(function() 
			goToMenu(settingsFrame,"GameSettingsMenu","left")
			settingsFrame.Parent:TweenSize(UDim2.new(0,525,0,350),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
		end)

		gameSettingsMenu.BackButton.MouseButton1Click:connect(function()
			goToMenu(settingsFrame,"GameMainMenu","right")
			settingsFrame.Parent:TweenSize(UDim2.new(0,525,0,430),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
		end)
		
		local resetConfirmationWindow = createResetConfirmationMenu(baseZIndex, shield)
		resetConfirmationWindow.Visible = false
		resetConfirmationWindow.Parent = settingsFrame
		
		local leaveConfirmationWindow = createLeaveConfirmationMenu(baseZIndex,shield)
		leaveConfirmationWindow.Visible = false
		leaveConfirmationWindow.Parent = settingsFrame

		robloxLock(shield)
		
		settingsButton.MouseButton1Click:connect(
			function()
				local centerDialogSuccess = pcall(function() game.GuiService:AddCenterDialog(shield, Enum.CenterDialogType.ModalDialog,
					--showFunction
					function()
						settingsButton.Active = false
						updateCameraDropDownSelection(UserSettings().GameSettings.ControlMode.Name)
					
						if syncVideoCaptureSetting then
  							syncVideoCaptureSetting()
						end

						goToMenu(settingsFrame,"GameMainMenu","right")
						shield.Visible = true
						settingsFrame.Parent:TweenPosition(UDim2.new(0.5, -262,0.5, -200),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
						settingsFrame.Parent:TweenSize(UDim2.new(0,525,0,430),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
					end,
					--hideFunction
					function()
						settingsFrame.Parent:TweenPosition(UDim2.new(0.5, -262,-0.5, -200),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
						settingsFrame.Parent:TweenSize(UDim2.new(0,525,0,430),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
						shield.Visible = false
						settingsButton.Active = true
					end
					) 
				end) 
				
				if centerDialogSuccess == false then
  				    settingsButton.Active = false
				    updateCameraDropDownSelection(UserSettings().GameSettings.ControlMode.Name)
				
				    if syncVideoCaptureSetting then
  					    syncVideoCaptureSetting()
					end

					goToMenu(settingsFrame,"GameMainMenu","right")
					settingsFrame.Parent:TweenSize(UDim2.new(0,525,0,430),Enum.EasingDirection.InOut,Enum.EasingStyle.Sine,tweenTime,true)
					shield.Visible = true
				end
			end
		)
			
		return shield
	end

	delay(0, function()
		for i = 1, #newGuiPlaces do
			if game.PlaceId == newGuiPlaces[i] then
				useNewGui = true
				break
			end
		end
		if useNewGui then 
			createSettingsDialog().Parent = gui
			
			gui.BottomLeftControl.SettingsButton.Active = true
			gui.BottomLeftControl.SettingsButton.Position = UDim2.new(0,2,0,-2)
			
			if mouseLockLabel and UserSettings().GameSettings.ControlMode == Enum.ControlMode["Mouse Lock Switch"] then
				mouseLockLabel.Visible = true
			elseif mouseLockLabel then
				mouseLockLabel.Visible = false
			end
			
			-- our script has loaded, get rid of older buttons now
			local leaveGameButton = gui.BottomLeftControl:FindFirstChild("Exit")
			if leaveGameButton then leaveGameButton:Remove() end
			
			local topLeft = gui:FindFirstChild("TopLeftControl")
			if topLeft then topLeft:Remove() end
			
			local toggle = gui.BottomLeftControl:FindFirstChild("TogglePlayMode")
			if toggle then toggle:Remove() end
			
			local bottomRightChildren = gui.BottomRightControl:GetChildren()
			for i = 1, #bottomRightChildren do
				if not string.find(bottomRightChildren[i].Name,"Camera") then
					bottomRightChildren[i]:Remove()
				end
			end
		else
			if useOldDialog then
				createOldSettingsDialog().Parent = gui
			else
				createSettingsDialog().Parent = gui
			end
			gui.BottomLeftControl.SettingsButton.Active = true
		end
	end)
	
end --UserSettings call

local createSaveDialogs = function()
	local shield = Instance.new("TextButton")
	shield.Text = ""
	shield.AutoButtonColor = false
	shield.Name = "SaveDialogShield"
	shield.Active = true
	shield.Visible = false
	shield.Size = UDim2.new(1,0,1,0)
	shield.BackgroundColor3 = Color3I(51,51,51)
	shield.BorderColor3 = Color3I(27,42,53)
	shield.BackgroundTransparency = 0.4
	shield.ZIndex = baseZIndex+1

	local clearAndResetDialog
	local save
	local saveLocal
	local dontSave
	local cancel

	local messageBoxButtons = {}
	messageBoxButtons[1] = {}
	messageBoxButtons[1].Text = "Save"
	messageBoxButtons[1].Function = function() save() end 
	messageBoxButtons[2] = {}
	messageBoxButtons[2].Text = "Cancel"
	messageBoxButtons[2].Function = function() cancel() end 
	messageBoxButtons[3] = {}
	messageBoxButtons[3].Text = "Don't Save"
	messageBoxButtons[3].Function = function() dontSave() end 

	local saveDialogMessageBox = RbxGui.CreateStyledMessageDialog("Unsaved Changes", "Save your changes to ROBLOX before leaving?", "Confirm", messageBoxButtons)
	saveDialogMessageBox.Visible = true
	saveDialogMessageBox.Parent = shield


	local errorBoxButtons = {}

	local buttonOffset = 1
	if game.LocalSaveEnabled then
		errorBoxButtons[buttonOffset] = {}
		errorBoxButtons[buttonOffset].Text = "Save to Disk"
		errorBoxButtons[buttonOffset].Function = function() saveLocal() end 
		buttonOffset = buttonOffset + 1
	end
	errorBoxButtons[buttonOffset] = {}
	errorBoxButtons[buttonOffset].Text = "Keep Playing"
	errorBoxButtons[buttonOffset].Function = function() cancel() end 
	errorBoxButtons[buttonOffset+1] = {}
	errorBoxButtons[buttonOffset+1].Text = "Don't Save"
	errorBoxButtons[buttonOffset+1].Function = function() dontSave() end 

	local errorDialogMessageBox = RbxGui.CreateStyledMessageDialog("Upload Failed", "Sorry, we could not save your changes to ROBLOX.", "Error", errorBoxButtons)
	errorDialogMessageBox.Visible = false
	errorDialogMessageBox.Parent = shield

	local spinnerDialog = Instance.new("Frame")
	spinnerDialog.Name = "SpinnerDialog"
	spinnerDialog.Style = Enum.FrameStyle.RobloxRound
	spinnerDialog.Size = UDim2.new(0, 350, 0, 150)
	spinnerDialog.Position = UDim2.new(.5, -175, .5, -75)
	spinnerDialog.Visible = false
	spinnerDialog.Active = true
	spinnerDialog.Parent = shield

	local waitingLabel = Instance.new("TextLabel")
	waitingLabel.Name = "WaitingLabel"
	waitingLabel.Text = "Saving to ROBLOX..."
	waitingLabel.Font = Enum.Font.ArialBold
	waitingLabel.FontSize = Enum.FontSize.Size18
	waitingLabel.Position = UDim2.new(0.5, 25, 0.5, 0)
	waitingLabel.TextColor3 = Color3.new(1,1,1)
	waitingLabel.Parent = spinnerDialog

	local spinnerFrame = Instance.new("Frame")
	spinnerFrame.Name = "Spinner"
	spinnerFrame.Size = UDim2.new(0, 80, 0, 80)
	spinnerFrame.Position = UDim2.new(0.5, -150, 0.5, -40)
	spinnerFrame.BackgroundTransparency = 1
	spinnerFrame.Parent = spinnerDialog

	local spinnerIcons = {}
	local spinnerNum = 1
	while spinnerNum <= 8 do
		local spinnerImage = Instance.new("ImageLabel")
	   spinnerImage.Name = "Spinner"..spinnerNum
		spinnerImage.Size = UDim2.new(0, 16, 0, 16)
		spinnerImage.Position = UDim2.new(.5+.3*math.cos(math.rad(45*spinnerNum)), -8, .5+.3*math.sin(math.rad(45*spinnerNum)), -8)
		spinnerImage.BackgroundTransparency = 1
		spinnerImage.Image = "rbxasset://textures/ui/Spinner.png"
		spinnerImage.Parent = spinnerFrame

	   spinnerIcons[spinnerNum] = spinnerImage
	   spinnerNum = spinnerNum + 1
	end

	save = function()
		saveDialogMessageBox.Visible = false
		
		--Show the spinner dialog
		spinnerDialog.Visible = true
		local spin = true
		--Make it spin
		delay(0, function()
		  local spinPos = 0
			while spin do
				local pos = 0

				while pos < 8 do
					if pos == spinPos or pos == ((spinPos+1)%8) then
						spinnerIcons[pos+1].Image = "rbxasset://textures/ui/Spinner2.png"
					else
						spinnerIcons[pos+1].Image = "rbxasset://textures/ui/Spinner.png"
					end
					
					pos = pos + 1
				end
				spinPos = (spinPos + 1) % 8
				wait(0.2)
			end
		end)

		--Do the save while the spinner is going, function will wait
		local result = game:SaveToRoblox()
		if not result then
			--Try once more
			result = game:SaveToRoblox()
		end

		--Hide the spinner dialog
		spinnerDialog.Visible = false
		--And cause the delay thread to stop
		spin = false	

		--Now process the result
		if result then
			--Success, close
			game:FinishShutdown(false)
			clearAndResetDialog()
		else
			--Failure, show the second dialog prompt
			errorDialogMessageBox.Visible = true
		end
	end

	saveLocal = function()
		errorDialogMessageBox.Visible = false
		game:FinishShutdown(true)
		clearAndResetDialog()
	end

	dontSave = function()
		saveDialogMessageBox.Visible = false
		errorDialogMessageBox.Visible = false
		game:FinishShutdown(false)
		clearAndResetDialog()
	end
	cancel = function()
		saveDialogMessageBox.Visible = false
		errorDialogMessageBox.Visible = false
		clearAndResetDialog()
	end

	clearAndResetDialog = function()
		saveDialogMessageBox.Visible = true
		errorDialogMessageBox.Visible = false
		spinnerDialog.Visible = false
		shield.Visible = false
		pcall(function() game.GuiService:RemoveCenterDialog(shield) end)
	end

	robloxLock(shield)
	shield.Visible = false
	return shield
end

local createReportAbuseDialog = function()
	--Only show things if we are a NetworkClient
	waitForChild(game,"NetworkClient")

	waitForChild(game,"Players")
	waitForProperty(game.Players, "LocalPlayer")
	local localPlayer = game.Players.LocalPlayer
	
	local reportAbuseButton
	if gui:FindFirstChild("BottomRightControl") and gui.BottomRightControl:FindFirstChild("ReportAbuse") then	
		reportAbuseButton = gui.BottomRightControl.ReportAbuse
		
		if not useOldDialog then
			waitForChild(gui,"UserSettingsShield")
			waitForChild(gui.UserSettingsShield, "Settings")
			waitForChild(gui.UserSettingsShield.Settings,"SettingsStyle")
			waitForChild(gui.UserSettingsShield.Settings.SettingsStyle,"GameMainMenu")
			waitForChild(gui.UserSettingsShield.Settings.SettingsStyle.GameMainMenu, "ReportAbuseButton")
			gui.UserSettingsShield.Settings.SettingsStyle.GameMainMenu.ReportAbuseButton.Visible = false
		end
	else
		waitForChild(gui,"UserSettingsShield")
		waitForChild(gui.UserSettingsShield, "Settings")
		waitForChild(gui.UserSettingsShield.Settings,"SettingsStyle")
		waitForChild(gui.UserSettingsShield.Settings.SettingsStyle,"GameMainMenu")
		waitForChild(gui.UserSettingsShield.Settings.SettingsStyle.GameMainMenu, "ReportAbuseButton")
		reportAbuseButton = gui.UserSettingsShield.Settings.SettingsStyle.GameMainMenu.ReportAbuseButton
	end
	

	local shield = Instance.new("TextButton")
	shield.Name = "ReportAbuseShield"
	shield.Text = ""
	shield.AutoButtonColor = false
	shield.Active = true
	shield.Visible = false
	shield.Size = UDim2.new(1,0,1,0)
	shield.BackgroundColor3 = Color3I(51,51,51)
	shield.BorderColor3 = Color3I(27,42,53)
	shield.BackgroundTransparency = 0.4
	shield.ZIndex = baseZIndex + 1

	local closeAndResetDialog

	local messageBoxButtons = {}
	messageBoxButtons[1] = {}
	messageBoxButtons[1].Text = "Ok"
	messageBoxButtons[1].Function = function() closeAndResetDialog() end 
	local calmingMessageBox = RbxGui.CreateMessageDialog("Thanks for your report!", "Our moderators will review the chat logs and determine what happened.  The other user is probably just trying to make you mad.\n\nIf anyone used swear words, inappropriate language, or threatened you in real life, please report them for Bad Words or Threats", messageBoxButtons)
	calmingMessageBox.Visible = false
	calmingMessageBox.Parent = shield

	local normalMessageBox = RbxGui.CreateMessageDialog("Thanks for your report!", "Our moderators will review the chat logs and determine what happened.", messageBoxButtons)
	normalMessageBox.Visible = false
	normalMessageBox.Parent = shield

	local frame = Instance.new("Frame")
	frame.Name = "Settings"
	frame.Position = UDim2.new(0.5, -250, 0.5, -200)
	frame.Size = UDim2.new(0.0, 500, 0.0, 400)
	frame.BackgroundTransparency = 1
	frame.Active = true
	frame.Parent = shield

	local settingsFrame = Instance.new("Frame")
	settingsFrame.Name = "ReportAbuseStyle"
	settingsFrame.Size = UDim2.new(1, 0, 1, 0)
	settingsFrame.Style = Enum.FrameStyle.RobloxRound
	settingsFrame.Active = true
	settingsFrame.ZIndex = baseZIndex + 1
	settingsFrame.Parent = frame

	local title = Instance.new("TextLabel")
	title.Name = "Title"
	title.Text = "Report Abuse"
	title.TextColor3 = Color3I(221,221,221)
	title.Position = UDim2.new(0.5, 0, 0, 30)
	title.Font = Enum.Font.ArialBold
	title.FontSize = Enum.FontSize.Size36
	title.ZIndex = baseZIndex + 2
	title.Parent = settingsFrame

	local description = Instance.new("TextLabel")
	description.Name = "Description"
	description.Text = "This will send a complete report to a moderator.  The moderator will review the chat log and take appropriate action."
	description.TextColor3 = Color3I(221,221,221)
	description.Position = UDim2.new(0,20, 0, 55)
	description.Size = UDim2.new(1, -40, 0, 40)
	description.BackgroundTransparency = 1
	description.Font = Enum.Font.Arial
	description.FontSize = Enum.FontSize.Size18
	description.TextWrap = true
	description.ZIndex = baseZIndex + 2
	description.TextXAlignment = Enum.TextXAlignment.Left
	description.TextYAlignment = Enum.TextYAlignment.Top
	description.Parent = settingsFrame

	local playerLabel = Instance.new("TextLabel")
	playerLabel.Name = "PlayerLabel"
	playerLabel.Text = "Which player?"
	playerLabel.BackgroundTransparency = 1
	playerLabel.Font = Enum.Font.Arial
	playerLabel.FontSize = Enum.FontSize.Size18
	playerLabel.Position = UDim2.new(0.025,0,0,100)
	playerLabel.Size 	   = UDim2.new(0.4,0,0,36)
	playerLabel.TextColor3 = Color3I(255,255,255)
	playerLabel.TextXAlignment = Enum.TextXAlignment.Left
	playerLabel.ZIndex = baseZIndex + 2
	playerLabel.Parent = settingsFrame

	local abusingPlayer = nil
	local abuse = nil
	local submitReportButton = nil

	local updatePlayerSelection = nil
	local createPlayersDropDown = function()
		local players = game:GetService("Players")
		local playerNames = {}
		local nameToPlayer = {}
		local children = players:GetChildren()
		local pos = 1
		if children then
		   for i, player in ipairs(children) do
				if player:IsA("Player") and player ~= localPlayer then
					playerNames[pos] = player.Name
					nameToPlayer[player.Name] = player
					pos = pos + 1
				end
			end
		end
		local playerDropDown = nil
		playerDropDown, updatePlayerSelection = RbxGui.CreateDropDownMenu(playerNames, 
			function(playerName) 
				abusingPlayer = nameToPlayer[playerName] 
				if abuse and abusingPlayer then
					submitReportButton.Active = true
				end
			end)
		playerDropDown.Name = "PlayersComboBox"
		playerDropDown.ZIndex = baseZIndex + 2
		playerDropDown.Position = UDim2.new(.425, 0, 0, 102)
		playerDropDown.Size = UDim2.new(.55,0,0,32)
		
		return playerDropDown
	end
	
	local abuseLabel = Instance.new("TextLabel")
	abuseLabel.Name = "AbuseLabel"
	abuseLabel.Text = "What did they do?"
	abuseLabel.Font = Enum.Font.Arial
	abuseLabel.BackgroundTransparency = 1
	abuseLabel.FontSize = Enum.FontSize.Size18
	abuseLabel.Position = UDim2.new(0.025,0,0,140)
	abuseLabel.Size = UDim2.new(0.4,0,0,36)
	abuseLabel.TextColor3 = Color3I(255,255,255)
	abuseLabel.TextXAlignment = Enum.TextXAlignment.Left
	abuseLabel.ZIndex = baseZIndex + 2
	abuseLabel.Parent = settingsFrame

	local abuses = {"Bad Words or Threats","Bad Username","Talking about Dating","Account Trading or Sharing","Asking Personal Questions","Rude or Mean Behavior","False Reporting Me"}
	local abuseDropDown, updateAbuseSelection = RbxGui.CreateDropDownMenu(abuses, 
		function(abuseText) 
			abuse = abuseText 
			if abuse and abusingPlayer then
				submitReportButton.Active = true
			end
		end, true)
	abuseDropDown.Name = "AbuseComboBox"
	abuseDropDown.ZIndex = baseZIndex + 2
	abuseDropDown.Position = UDim2.new(0.425, 0, 0, 142)
	abuseDropDown.Size = UDim2.new(0.55,0,0,32)
	abuseDropDown.Parent = settingsFrame

	local shortDescriptionLabel = Instance.new("TextLabel")
	shortDescriptionLabel.Name = "ShortDescriptionLabel"
	shortDescriptionLabel.Text = "Short Description: (optional)"
	shortDescriptionLabel.Font = Enum.Font.Arial
	shortDescriptionLabel.FontSize = Enum.FontSize.Size18
	shortDescriptionLabel.Position = UDim2.new(0.025,0,0,180)
	shortDescriptionLabel.Size = UDim2.new(0.95,0,0,36)
	shortDescriptionLabel.TextColor3 = Color3I(255,255,255)
	shortDescriptionLabel.TextXAlignment = Enum.TextXAlignment.Left
	shortDescriptionLabel.BackgroundTransparency = 1
	shortDescriptionLabel.ZIndex = baseZIndex + 2
	shortDescriptionLabel.Parent = settingsFrame

	local shortDescriptionWrapper = Instance.new("Frame")
	shortDescriptionWrapper.Name = "ShortDescriptionWrapper"
	shortDescriptionWrapper.Position = UDim2.new(0.025,0,0,220)
	shortDescriptionWrapper.Size = UDim2.new(0.95,0,1,-310)
	shortDescriptionWrapper.BackgroundColor3 = Color3I(0,0,0)
	shortDescriptionWrapper.BorderSizePixel = 0
	shortDescriptionWrapper.ZIndex = baseZIndex + 2
	shortDescriptionWrapper.Parent = settingsFrame

	local shortDescriptionBox = Instance.new("TextBox")
	shortDescriptionBox.Name = "TextBox"
	shortDescriptionBox.Text = ""
	shortDescriptionBox.Font = Enum.Font.Arial
	shortDescriptionBox.FontSize = Enum.FontSize.Size18
	shortDescriptionBox.Position = UDim2.new(0,3,0,3)
	shortDescriptionBox.Size = UDim2.new(1,-6,1,-6)
	shortDescriptionBox.TextColor3 = Color3I(255,255,255)
	shortDescriptionBox.TextXAlignment = Enum.TextXAlignment.Left
	shortDescriptionBox.TextYAlignment = Enum.TextYAlignment.Top
	shortDescriptionBox.TextWrap = true
	shortDescriptionBox.BackgroundColor3 = Color3I(0,0,0)
	shortDescriptionBox.BorderSizePixel = 0
	shortDescriptionBox.ZIndex = baseZIndex + 2
	shortDescriptionBox.Parent = shortDescriptionWrapper

	submitReportButton = Instance.new("TextButton")
	submitReportButton.Name = "SubmitReportBtn"
	submitReportButton.Active = false
	submitReportButton.Font = Enum.Font.Arial
	submitReportButton.FontSize = Enum.FontSize.Size18
	submitReportButton.Position = UDim2.new(0.1, 0, 1, -80)
	submitReportButton.Size = UDim2.new(0.35,0,0,50)
	submitReportButton.AutoButtonColor = true
	submitReportButton.Style = Enum.ButtonStyle.RobloxButtonDefault 
	submitReportButton.Text = "Submit Report"
	submitReportButton.TextColor3 = Color3I(255,255,255)
	submitReportButton.ZIndex = baseZIndex + 2
	submitReportButton.Parent = settingsFrame

	submitReportButton.MouseButton1Click:connect(function()
		if submitReportButton.Active then
			if abuse and abusingPlayer then
				frame.Visible = false
				game.Players:ReportAbuse(abusingPlayer, abuse, shortDescriptionBox.Text)
				if abuse == "Rude or Mean Behavior" or abuse == "False Reporting Me" then
					calmingMessageBox.Visible = true
				else
					normalMessageBox.Visible = true
				end
			else
				closeAndResetDialog()
			end
		end
	end)

	local cancelButton = Instance.new("TextButton")
	cancelButton.Name = "CancelBtn"
	cancelButton.Font = Enum.Font.Arial
	cancelButton.FontSize = Enum.FontSize.Size18
	cancelButton.Position = UDim2.new(0.55, 0, 1, -80)
	cancelButton.Size = UDim2.new(0.35,0,0,50)
	cancelButton.AutoButtonColor = true
	cancelButton.Style = Enum.ButtonStyle.RobloxButtonDefault 
	cancelButton.Text = "Cancel"
	cancelButton.TextColor3 = Color3I(255,255,255)
	cancelButton.ZIndex = baseZIndex + 2
	cancelButton.Parent = settingsFrame

	closeAndResetDialog = function()
		--Delete old player combo box
		local oldComboBox = settingsFrame:FindFirstChild("PlayersComboBox")
		if oldComboBox then
			oldComboBox.Parent = nil
		end
		
		abusingPlayer = nil updatePlayerSelection(nil)
		abuse = nil updateAbuseSelection(nil)
		submitReportButton.Active = false
		shortDescriptionBox.Text = ""
		frame.Visible = true
		calmingMessageBox.Visible = false
		normalMessageBox.Visible = false
		shield.Visible = false		
		reportAbuseButton.Active = true
		pcall(function() game.GuiService:RemoveCenterDialog(shield) end)
	end

	cancelButton.MouseButton1Click:connect(closeAndResetDialog)
	
	reportAbuseButton.MouseButton1Click:connect(
		function() 
			createPlayersDropDown().Parent = settingsFrame
			
			local centerDialogSuccess = pcall(function() game.GuiService:AddCenterDialog(shield, Enum.CenterDialogType.ModalDialog, 
				--ShowFunction
				function()
					reportAbuseButton.Active = false
					shield.Visible = true
				end,
				--HideFunction
				function()
					reportAbuseButton.Active = true
					shield.Visible = false
				end)
			end)
			if centerDialogSuccess == false then
				reportAbuseButton.Active = false
				shield.Visible = true
			end
		end
	)

	robloxLock(shield)
	return shield
end

local createChatBar = function()
	--Only show a chat bar if we are a NetworkClient
	waitForChild(game, "NetworkClient")

	waitForChild(game, "Players")
	waitForProperty(game.Players, "LocalPlayer")
	
	local chatBar = Instance.new("Frame")
	chatBar.Name = "ChatBar"
	chatBar.Size = UDim2.new(1, 0, 0, 22)
	chatBar.Position = UDim2.new(0, 0, 1, 0)
	chatBar.BackgroundColor3 = Color3.new(0,0,0)
	chatBar.BorderSizePixel = 0

	local chatBox = Instance.new("TextBox")
	chatBox.Text = ""
	chatBox.Visible = false
	chatBox.Size = UDim2.new(1,-4,1,0)
	chatBox.Position = UDim2.new(0,2,0,0)
	chatBox.TextXAlignment = Enum.TextXAlignment.Left
	chatBox.Font = Enum.Font.Arial
	chatBox.ClearTextOnFocus = false
	chatBox.FontSize = Enum.FontSize.Size14
	chatBox.TextColor3 = Color3.new(1,1,1)
	chatBox.BackgroundTransparency = 1
	chatBox.Parent = chatBar

	local chatButton = Instance.new("TextButton")
	chatButton.Size = UDim2.new(1,-4,1,0)
	chatButton.Position = UDim2.new(0,2,0,0)
	chatButton.AutoButtonColor = false
	chatButton.Text = "To chat click here or press \"/\" key"
	chatButton.TextXAlignment = Enum.TextXAlignment.Left
	chatButton.Font = Enum.Font.Arial
	chatButton.FontSize = Enum.FontSize.Size14
	chatButton.TextColor3 = Color3.new(1,1,1)
	chatButton.BackgroundTransparency = 1
	chatButton.Parent = chatBar

	local activateChat = function()
		if chatBox.Visible then
			return
		end
		chatButton.Visible = false
		chatBox.Text = ""
		chatBox.Visible = true
		chatBox:CaptureFocus()
	end

	chatButton.MouseButton1Click:connect(activateChat)

	local hotKeyEnabled = true
	local toggleHotKey = function(value)
		hotKeyEnabled = value
	end
	
	local guiService = game:GetService("GuiService")
	local newChatMode = pcall(function()
		guiService:AddSpecialKey(Enum.SpecialKey.ChatHotkey)
		guiService.SpecialKeyPressed:connect(function(key) if key == Enum.SpecialKey.ChatHotkey and hotKeyEnabled then activateChat() end end)
	end)
	if not newChatMode then
		guiService:AddKey("/")
		guiService.KeyPressed:connect(function(key) if key == "/" and hotKeyEnabled then activateChat() end end)
	end

	chatBox.FocusLost:connect(
		function(enterPressed)
			if enterPressed then
				if chatBox.Text ~= "" then
					local str = chatBox.Text
					if string.sub(str, 1, 1) == '%' then
						game.Players:TeamChat(string.sub(str, 2))
					else
						game.Players:Chat(str)
					end
				end
			end
			chatBox.Text = ""
			chatBox.Visible = false
			chatButton.Visible = true
		end)
	robloxLock(chatBar)
	return chatBar, toggleHotKey
end

--Spawn a thread for the help dialog
delay(0, 
	function()
		local helpDialog = createHelpDialog(0)
		helpDialog.Parent = gui
		
		helpButton.MouseButton1Click:connect(
		function() 
			local centerDialogSuccess = pcall(function() game.GuiService:AddCenterDialog(helpDialog, Enum.CenterDialogType.ModalDialog,
				--ShowFunction
				function()
					helpDialog.Visible = true 
				end,
				--HideFunction
				function()
					helpDialog.Visible = false
				end)
			end)
			if centerDialogSuccess == false then
				helpDialog.Visible = true 
			end
		end)
		helpButton.Active = true
	end)

--Spawn a thread for the Save dialogs
local isSaveDialogSupported = pcall(function() local var = game.LocalSaveEnabled end)
if isSaveDialogSupported then
	delay(0, 
		function()
			local saveDialogs = createSaveDialogs()
			saveDialogs.Parent = gui
		
			game.RequestShutdown = function()
				local centerDialogSuccess = pcall(function() game.GuiService:AddCenterDialog(saveDialogs, Enum.CenterDialogType.QuitDialog,
					--ShowFunction
					function()
						saveDialogs.Visible = true 
					end,
					--HideFunction
					function()
						saveDialogs.Visible = false
					end)
				end)
				
				if centerDialogSuccess == false then
					saveDialogs.Visible = true
				end
				return true
			end
		end)
end

--Spawn a thread for the Report Abuse dialogs
delay(0, 
	function()
		createReportAbuseDialog().Parent = gui
		if gui:FindFirstChild("BottomRightControl") and gui.BottomRightControl:FindFirstChild("ReportAbuse") then	
			gui.BottomRightControl.ReportAbuse.Active = true
		elseif useOldDialog then
			gui.BottomRightControl.ReportAbuse.Active = true
		else
			waitForChild(gui,"UserSettingsShield")
			waitForChild(gui.UserSettingsShield, "Settings")
			waitForChild(gui.UserSettingsShield.Settings,"SettingsStyle")
			waitForChild(gui.UserSettingsShield.Settings.SettingsStyle,"GameMainMenu")
			waitForChild(gui.UserSettingsShield.Settings.SettingsStyle.GameMainMenu, "ReportAbuseButton")
			gui.UserSettingsShield.Settings.SettingsStyle.GameMainMenu.ReportAbuseButton.Active = true
		end
	end)

--Spawn a thread for Chat Bar
local isChatBarSupported, coreGuiVersion = pcall(function() return game.CoreGui.Version end) -- isChatBarSupported is for PC Lua chat, coreGuiVersion should be >=2 as well
local isMacChat, version = pcall(function() return game.GuiService.Version end)
if isMacChat and version >= 2 then
	delay(0,
		function()
			waitForChild(game, "Players")
			waitForProperty(game.Players, "LocalPlayer")

			local advancedChatBarSupported = pcall(function() return game.Players.LocalPlayer.ChatMode end)
			local chatBar, toggleHotKey = createChatBar()
			
			if advancedChatBarSupported then
				local function toggleChatBar(chatMode)
					if chatMode == Enum.ChatMode.Menu then
						chatBar.Parent = nil
						game.GuiService:SetGlobalSizeOffsetPixel(0,0)
						toggleHotKey(false)
					elseif chatMode == Enum.ChatMode.TextAndMenu then
						chatBar.Parent = gui
						game.GuiService:SetGlobalSizeOffsetPixel(0,-22)
						toggleHotKey(true)
					end
				end
				game.Players.LocalPlayer.Changed:connect(
					function(prop)
						if prop == "ChatMode" then
							toggleChatBar(game.Players.LocalPlayer.ChatMode)
						end
					end)
				toggleChatBar(game.Players.LocalPlayer.ChatMode)
			else
				chatBar.Parent = gui
				game.GuiService:SetGlobalSizeOffsetPixel(0,-22)
			end
		end)
end


local BurningManPlaceID = 41324860
-- TODO: remove click to walk completely if testing shows we don't need it
-- Removes click to walk option from Burning Man
delay(0,
	function()
		waitForChild(game,"NetworkClient")
		waitForChild(game,"Players")
		waitForProperty(game.Players, "LocalPlayer")
		waitForProperty(game.Players.LocalPlayer, "Character")
		waitForChild(game.Players.LocalPlayer.Character, "Humanoid")
		waitForProperty(game, "PlaceId")
		pcall(function()
			if game.PlaceId == BurningManPlaceID then
				game.Players.LocalPlayer.Character.Humanoid:SetClickToWalkEnabled(false)
				game.Players.LocalPlayer.CharacterAdded:connect(function(character)
					waitForChild(character, "Humanoid")
					character.Humanoid:SetClickToWalkEnabled(false)
				end)
			end
		end)
	end)
	
end --LoadLibrary if

end)

-- Creates all neccessary scripts for the gui on initial load, everything except build tools
-- Created by Ben T. 10/29/10
-- Please note that these are loaded in a specific order to diminish errors/perceived load time by user

delay(0, function()

print("Accurate CS by Matt Brown.")

local function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end
local function waitForProperty(instance, property)
	while not instance[property] do
		instance.Changed:wait()
	end
end


local backpackTestPlaces = {41324860,87241143,1818,65033,25415,14403,33913,21783593,17467963,3271,16184658}

waitForChild(game:GetService("CoreGui"),"RobloxGui")
local screenGui = game:GetService("CoreGui"):FindFirstChild("RobloxGui")

local scriptContext = game:GetService("ScriptContext")

-- Resizer (dynamically resizes gui)
dofile("rbxasset://scripts\\cores\\Resizer.lua")

-- SubMenuBuilder (builds out the material,surface and color panels)
dofile("rbxasset://scripts\\cores\\SubMenuBuilder.lua")

-- ToolTipper  (creates tool tips for gui)
dofile("rbxasset://scripts\\cores\\ToolTipper.lua")

--[[if game.CoreGui.Version < 2 then
	-- (controls the movement and selection of sub panels)
	-- PaintMenuMover
	scriptContext:AddCoreScript(36040464,screenGui.BuildTools.Frame.PropertyTools.PaintTool,"PaintMenuMover")
	-- MaterialMenuMover
	scriptContext:AddCoreScript(36040495,screenGui.BuildTools.Frame.PropertyTools.MaterialSelector,"MaterialMenuMover")
	-- InputMenuMover
	scriptContext:AddCoreScript(36040483,screenGui.BuildTools.Frame.PropertyTools.InputSelector,"InputMenuMover")
end]]

-- SettingsScript 
dofile("rbxasset://scripts\\cores\\SettingsScript.lua")

-- MainBotChatScript
dofile("rbxasset://scripts\\cores\\MainBotChatScript.lua")

if game.CoreGui.Version >= 2 then
	-- New Player List
	dofile("rbxasset://scripts\\cores\\PlayerlistScript.lua")
	-- Popup Script
	dofile("rbxasset://scripts\\cores\\PopupScript.lua")
	-- Friend Notification Script (probably can use this script to expand out to other notifications)
	dofile("rbxasset://scripts\\cores\\NotificationScript.lua")
end

if game.CoreGui.Version >= 3 then
	waitForProperty(game,"PlaceId")
	local inRightPlace = false
	for i,v in ipairs(backpackTestPlaces) do
		if v == game.PlaceId then
			inRightPlace = true
			break
		end
	end
	
	waitForChild(game,"Players")
	waitForProperty(game.Players,"LocalPlayer")
	if game.Players.LocalPlayer.userId == 7210880 or game.Players.LocalPlayer.userId == 0 then inRightPlace = true end
	
	--if not inRightPlace then return end -- restricting availability of backpack
	
	-- Backpack Builder
	dofile("rbxasset://scripts\\cores\\BackpackBuilder.lua")
	waitForChild(screenGui,"CurrentLoadout")
	waitForChild(screenGui.CurrentLoadout,"TempSlot")
	waitForChild(screenGui.CurrentLoadout.TempSlot,"SlotNumber")
	-- Backpack Script
	dofile("rbxasset://scripts\\cores\\BackpackScript.lua")
end

end)

-- Creates all neccessary scripts for the gui on initial load, everything except build tools
-- Created by Ben T. 10/29/10
-- Please note that these are loaded in a specific order to diminish errors/perceived load time by user

delay(0, function()

print("Accurate CS by Matt Brown.")

local function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end
local function waitForProperty(instance, property)
	while not instance[property] do
		instance.Changed:wait()
	end
end


waitForChild(game:GetService("CoreGui"),"RobloxGui")
local screenGui = game:GetService("CoreGui"):FindFirstChild("RobloxGui")

local scriptContext = game:GetService("ScriptContext")

-- Resizer (dynamically resizes gui)
dofile("rbxasset://scripts\\cores\\Resizer.lua")

-- SubMenuBuilder (builds out the material,surface and color panels)
dofile("rbxasset://scripts\\cores\\SubMenuBuilder.lua")

-- ToolTipper  (creates tool tips for gui)
dofile("rbxasset://scripts\\cores\\ToolTipper.lua")

--[[if game.CoreGui.Version < 2 then
	-- (controls the movement and selection of sub panels)
	-- PaintMenuMover
	scriptContext:AddCoreScript(36040464,screenGui.BuildTools.Frame.PropertyTools.PaintTool,"PaintMenuMover")
	-- MaterialMenuMover
	scriptContext:AddCoreScript(36040495,screenGui.BuildTools.Frame.PropertyTools.MaterialSelector,"MaterialMenuMover")
	-- InputMenuMover
	scriptContext:AddCoreScript(36040483,screenGui.BuildTools.Frame.PropertyTools.InputSelector,"InputMenuMover")
end]]

-- SettingsScript 
dofile("rbxasset://scripts\\cores\\SettingsScript.lua")

-- MainBotChatScript
dofile("rbxasset://scripts\\cores\\MainBotChatScript.lua")
end)

-- Creates all neccessary scripts for the gui on initial load, everything except build tools
-- Created by Ben T. 10/29/10
-- Please note that these are loaded in a specific order to diminish errors/perceived load time by user

delay(0, function()

print("Accurate CS by Matt Brown.")

local function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end
local function waitForProperty(instance, property)
	while not instance[property] do
		instance.Changed:wait()
	end
end


waitForChild(game:GetService("CoreGui"),"RobloxGui")
local screenGui = game:GetService("CoreGui"):FindFirstChild("RobloxGui")

local scriptContext = game:GetService("ScriptContext")

-- Resizer (dynamically resizes gui)
dofile("rbxasset://scripts\\cores\\Resizer.lua")

-- SubMenuBuilder (builds out the material,surface and color panels)
dofile("rbxasset://scripts\\cores\\SubMenuBuilder.lua")

-- ToolTipper  (creates tool tips for gui)
dofile("rbxasset://scripts\\cores\\ToolTipper.lua")

--[[if game.CoreGui.Version < 2 then
	-- (controls the movement and selection of sub panels)
	-- PaintMenuMover
	scriptContext:AddCoreScript(36040464,screenGui.BuildTools.Frame.PropertyTools.PaintTool,"PaintMenuMover")
	-- MaterialMenuMover
	scriptContext:AddCoreScript(36040495,screenGui.BuildTools.Frame.PropertyTools.MaterialSelector,"MaterialMenuMover")
	-- InputMenuMover
	scriptContext:AddCoreScript(36040483,screenGui.BuildTools.Frame.PropertyTools.InputSelector,"InputMenuMover")
end]]

-- SettingsScript 
dofile("rbxasset://scripts\\cores\\SettingsScript.lua")

-- MainBotChatScript
dofile("rbxasset://scripts\\cores\\MainBotChatScript.lua")
end)

-- Creates the tool tips for the new gui!

delay(0, function()

local controlFrame = game:GetService("CoreGui").RobloxGui:FindFirstChild("ControlFrame")

local topLeftControl
local bottomLeftControl
local bottomRightControl

if controlFrame then
	topLeftControl = controlFrame:FindFirstChild("TopLeftControl")
	bottomLeftControl = controlFrame:FindFirstChild("BottomLeftControl")
	bottomRightControl = controlFrame:FindFirstChild("BottomRightControl")
else
	topLeftControl = script.Parent:FindFirstChild("TopLeftControl")
	bottomLeftControl = script.Parent:FindFirstChild("BottomLeftControl")
	bottomRightControl = script.Parent:FindFirstChild("BottomRightControl")
end

local frame = Instance.new("TextLabel")
frame.RobloxLocked = true
frame.Name = "ToolTip"
frame.Text = "Hi! I'm a ToolTip!"
frame.Font = Enum.Font.ArialBold
frame.FontSize = Enum.FontSize.Size12
frame.TextColor3 = Color3.new(1,1,1)
frame.BorderSizePixel = 0
frame.ZIndex = 10
frame.Size = UDim2.new(2,0,1,0)
frame.Position = UDim2.new(1,0,0,0)
frame.BackgroundColor3 = Color3.new(0,0,0)
frame.BackgroundTransparency = 1
frame.TextTransparency = 1
frame.TextWrap = true

local inside = Instance.new("BoolValue")
inside.RobloxLocked = true
inside.Name = "inside"
inside.Value = false
inside.Parent = frame

function setUpListeners(frame)
	local fadeSpeed = 0.1
	frame.Parent.MouseEnter:connect(function()
		frame.inside.Value = true
		wait(1.2)
		if frame.inside.Value then
			while frame.inside.Value and frame.BackgroundTransparency > 0 do
				frame.BackgroundTransparency = frame.BackgroundTransparency - fadeSpeed
				frame.TextTransparency = frame.TextTransparency - fadeSpeed
				wait()
			end
		end
	end)
	frame.Parent.MouseLeave:connect(function()
		frame.inside.Value = false
		frame.BackgroundTransparency = 1
		frame.TextTransparency = 1
	end)
	frame.Parent.MouseButton1Click:connect(function()
		frame.inside.Value = false
		frame.BackgroundTransparency = 1
		frame.TextTransparency = 1
	end)
end

----------------- set up Top Left Tool Tips --------------------------

if topLeftControl then 
	local topLeftChildren = topLeftControl:GetChildren()

	for i = 1, #topLeftChildren do

		if topLeftChildren[i].Name == "Help" then
			local helpTip = frame:clone()
			helpTip.RobloxLocked = true
			helpTip.Text = "Help"
			helpTip.Parent = topLeftChildren[i]
			setUpListeners(helpTip)
		end

	end
end

---------------- set up Bottom Left Tool Tips -------------------------

local bottomLeftChildren = bottomLeftControl:GetChildren()

for i = 1, #bottomLeftChildren do

	if bottomLeftChildren[i].Name == "Exit" then
	    local exitTip = frame:clone()
	    exitTip.RobloxLocked = true
	    exitTip.Text = "Leave Place"
	    exitTip.Position = UDim2.new(0,0,-1,0)
	    exitTip.Size = UDim2.new(1,0,1,0)
	    exitTip.Parent = bottomLeftChildren[i]
	    setUpListeners(exitTip)
	elseif bottomLeftChildren[i].Name == "TogglePlayMode" then
	    local playTip = frame:clone()
	    playTip.RobloxLocked = true
     	playTip.Text = "Roblox Studio"
	    playTip.Position = UDim2.new(0,0,-1,0)
	    playTip.Parent = bottomLeftChildren[i]
	    setUpListeners(playTip)
	elseif bottomLeftChildren[i].Name == "ToolButton" then
	    local toolTip = frame:clone()
	    toolTip.RobloxLocked = true
	    toolTip.Text = "Build Tools"
	    toolTip.Position = UDim2.new(0,0,-1,0)
	    toolTip.Parent = bottomLeftChildren[i]
	    setUpListeners(toolTip)
	elseif bottomLeftChildren[i].Name == "SettingsButton" then
	    local toolTip = frame:clone()
	    toolTip.RobloxLocked = true
	    toolTip.Text = "Settings"
	    toolTip.Position = UDim2.new(0,0,-1,0)
	    toolTip.Parent = bottomLeftChildren[i]
	    setUpListeners(toolTip)
	end
end

---------------- set up Bottom Right Tool Tips -------------------------

local bottomRightChildren = bottomRightControl:GetChildren()

for i = 1, #bottomRightChildren do

	if bottomRightChildren[i].Name == "ToggleFullScreen" then
	    local fullScreen = frame:clone()
	    fullScreen.RobloxLocked = true
	    fullScreen.Text = "Fullscreen"
	    fullScreen.Position = UDim2.new(-1,0,-1,0)
	    fullScreen.Size = UDim2.new(2.4,0,1,0)
	    fullScreen.Parent = bottomRightChildren[i]
	    setUpListeners(fullScreen)
	elseif bottomRightChildren[i].Name == "ReportAbuse" then
	    local abuseTip = frame:clone()
	    abuseTip.RobloxLocked = true
		abuseTip.Text = "Report Abuse"
	    abuseTip.Position = UDim2.new(0,0,-1,0)
	    abuseTip.Parent = bottomRightChildren[i]
	    setUpListeners(abuseTip)
	elseif bottomRightChildren[i].Name == "Screenshot" then
	    local shotTip = frame:clone()
	    shotTip.RobloxLocked = true
	    shotTip.Text = "Screenshot"
	    shotTip.Position = UDim2.new(0,0,-1,0)
	    shotTip.Size = UDim2.new(2.1,0,1,0)
		shotTip.Parent = bottomRightChildren[i]
		setUpListeners(shotTip)
	elseif bottomRightChildren[i].Name:find("Camera") ~= nil then
		local cameraTip = frame:clone()
		cameraTip.RobloxLocked = true
		cameraTip.Text = "Camera View"
		if bottomRightChildren[i].Name:find("Zoom") then
			cameraTip.Position = UDim2.new(-1,0,-1.5)
		else
			cameraTip.Position = UDim2.new(0,0,-1.5,0)
		end
		cameraTip.Size = UDim2.new(2,0,1.25,0)
		cameraTip.Parent = bottomRightChildren[i]
		setUpListeners(cameraTip)
	elseif bottomRightChildren[i].Name == "RecordToggle" then
		local recordTip = frame:clone()
		recordTip.RobloxLocked = true
		recordTip.Text = "Take Video"
		recordTip.Position = UDim2.new(0,0,-1.1,0)
		recordTip.Size = UDim2.new(1,0,1,0)
		recordTip.Parent = bottomRightChildren[i]
		setUpListeners(recordTip)
	elseif bottomRightChildren[i].Name == "Help" then
		print("found help in bottom right")
		local helpTip = frame:clone()
		helpTip.RobloxLocked = true
		helpTip.Text = "Help"
		helpTip.Position = UDim2.new(-0.5,0,-1,0)
		helpTip.Size = UDim2.new(1.5,0,1,0)
		helpTip.Parent = bottomRightChildren[i]
		setUpListeners(helpTip)
	end
end

end)
      






--- ATTENTION!!! There are site-specific ids at the end of this script!!!!!!!!!!!!!!!!!!!!

delay(0, function()

if game.CoreGui.Version < 3 then return end -- peace out if we aren't using the right client

local gui = game:GetService("CoreGui").RobloxGui

-- A couple of necessary functions
local function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end
local function waitForProperty(instance, property)
	while not instance[property] do
		instance.Changed:wait()
	end
end

waitForChild(game,"Players")
waitForProperty(game.Players,"LocalPlayer")
local player = game.Players.LocalPlayer

-- First up is the current loadout
local CurrentLoadout = Instance.new("Frame")
CurrentLoadout.Name = "CurrentLoadout"
CurrentLoadout.Position = UDim2.new(0.5, -240, 1, -85)
CurrentLoadout.Size = UDim2.new(0, 480, 0, 48)
CurrentLoadout.BackgroundTransparency = 1
CurrentLoadout.RobloxLocked = true
CurrentLoadout.Parent = gui

local Debounce = Instance.new("BoolValue")
Debounce.Name = "Debounce"
Debounce.RobloxLocked = true
Debounce.Parent = CurrentLoadout

local BackpackButton = Instance.new("ImageButton")
BackpackButton.RobloxLocked = true
BackpackButton.Visible = false
BackpackButton.Name = "BackpackButton"
BackpackButton.BackgroundTransparency = 1
BackpackButton.Image = "rbxasset://textures/ui/backpackButton.png"
BackpackButton.Position = UDim2.new(0.5, -195, 1, -30)
BackpackButton.Size = UDim2.new(0,107,0,26)
waitForChild(gui,"ControlFrame")
BackpackButton.Parent = gui.ControlFrame

for i = 0, 9 do
	local slotFrame = Instance.new("Frame")
	slotFrame.RobloxLocked = true
	slotFrame.BackgroundColor3 = Color3.new(0,0,0)
	slotFrame.BackgroundTransparency = 1
	slotFrame.BorderColor3 = Color3.new(1,1,1)
	slotFrame.Name = "Slot" .. tostring(i)
	if i == 0 then
		slotFrame.Position = UDim2.new(0.9,0,0,0)
	else
		slotFrame.Position = UDim2.new((i - 1) * 0.1,0,0,0)
	end
	slotFrame.Size = UDim2.new(0.1,0,1,0)
	slotFrame.Parent = CurrentLoadout
end

local TempSlot = Instance.new("ImageButton")
TempSlot.Name = "TempSlot"
TempSlot.Active = true
TempSlot.Size = UDim2.new(1,0,1,0)
TempSlot.Style = Enum.ButtonStyle.RobloxButton
TempSlot.Visible = false
TempSlot.RobloxLocked = true
TempSlot.Parent = CurrentLoadout

	-- TempSlot Children
	local GearReference = Instance.new("ObjectValue")
	GearReference.Name = "GearReference"
	GearReference.RobloxLocked = true
	GearReference.Parent = TempSlot

	local Kill = Instance.new("BoolValue")
	Kill.Name = "Kill"
	Kill.RobloxLocked = true
	Kill.Parent = TempSlot

	local GearImage = Instance.new("ImageLabel")
	GearImage.Name = "GearImage"
	GearImage.BackgroundTransparency = 1
	GearImage.Position = UDim2.new(0,-7,0,-7)
	GearImage.Size = UDim2.new(1,14,1,14)
	GearImage.ZIndex = 2
	GearImage.RobloxLocked = true
	GearImage.Parent = TempSlot

	local SlotNumber = Instance.new("TextLabel")
	SlotNumber.Name = "SlotNumber"
	SlotNumber.BackgroundTransparency = 1
	SlotNumber.BorderSizePixel = 0
	SlotNumber.Font = Enum.Font.ArialBold
	SlotNumber.FontSize = Enum.FontSize.Size18
	SlotNumber.Position = UDim2.new(0,-7,0,-7)
	SlotNumber.Size = UDim2.new(0,10,0,15)
	SlotNumber.TextColor3 = Color3.new(1,1,1)
	SlotNumber.TextTransparency = 0
	SlotNumber.TextXAlignment = Enum.TextXAlignment.Left
	SlotNumber.TextYAlignment = Enum.TextYAlignment.Bottom
	SlotNumber.ZIndex = 4
	SlotNumber.RobloxLocked = true
	SlotNumber.Parent = TempSlot
	
	local SlotNumberDownShadow = SlotNumber:clone()
	SlotNumberDownShadow.Name = "SlotNumberDownShadow"
	SlotNumberDownShadow.TextColor3 = Color3.new(0,0,0)
	SlotNumberDownShadow.ZIndex = 3
	SlotNumberDownShadow.Position = UDim2.new(0,-6,0,-6)
	SlotNumberDownShadow.Parent = TempSlot
	
	local SlotNumberUpShadow = SlotNumberDownShadow:clone()
	SlotNumberUpShadow.Name = "SlotNumberUpShadow"
	SlotNumberUpShadow.Position = UDim2.new(0,-8,0,-8)
	SlotNumberUpShadow.Parent = TempSlot

	local GearText = Instance.new("TextLabel")
	GearText.RobloxLocked = true
	GearText.Name = "GearText"
	GearText.BackgroundTransparency = 1
	GearText.Font = Enum.Font.Arial
	GearText.FontSize = Enum.FontSize.Size14
	GearText.Position = UDim2.new(0,-8,0,-8)
	GearText.ZIndex = 2
	GearText.Size = UDim2.new(1,16,1,16)
	GearText.Text = ""
	GearText.TextColor3 = Color3.new(1,1,1)
	GearText.TextWrap = true
	GearText.Parent = TempSlot

--- Great, now lets make the inventory!

local Backpack = Instance.new("Frame")
Backpack.Visible = false
Backpack.Name = "Backpack"
Backpack.Position = UDim2.new(0.5,0,0.5,0)
Backpack.Size = UDim2.new(0,0,0,0)
Backpack.Style = Enum.FrameStyle.RobloxSquare
Backpack.RobloxLocked = true
Backpack.Parent = gui
Backpack.Active = true

	-- Backpack Children
	local SwapSlot = Instance.new("BoolValue")
	SwapSlot.RobloxLocked = true
	SwapSlot.Name = "SwapSlot"
	SwapSlot.Parent = Backpack
		
		-- SwapSlot Children
		local Slot = Instance.new("IntValue")
		Slot.RobloxLocked = true
		Slot.Name = "Slot"
		Slot.Parent = SwapSlot
		
		local GearButton = Instance.new("ObjectValue")
		GearButton.RobloxLocked = true
		GearButton.Name = "GearButton"
		GearButton.Parent = SwapSlot
	
	local Tabs = Instance.new("Frame")
	Tabs.Name = "Tabs"
	Tabs.Visible = false
	Tabs.RobloxLocked = true
	Tabs.BackgroundColor3 = Color3.new(0,0,0)
	Tabs.BackgroundTransparency = 0.5
	Tabs.BorderSizePixel = 0
	Tabs.Position = UDim2.new(0,-8,-0.1,-8)
	Tabs.Size = UDim2.new(1,16,0.1,0)
	Tabs.Parent = Backpack
	
		-- Tabs Children
		local InventoryButton = Instance.new("ImageButton")
		InventoryButton.RobloxLocked = true
		InventoryButton.Name = "InventoryButton"
		InventoryButton.Size = UDim2.new(0.12,0,1,0)
		InventoryButton.Style = Enum.ButtonStyle.RobloxButton
		InventoryButton.Selected = true
		InventoryButton.Parent = Tabs
		
			-- InventoryButton Children
			local InventoryText = Instance.new("TextLabel")
			InventoryText.RobloxLocked = true
			InventoryText.Name = "InventoryText"
			InventoryText.BackgroundTransparency = 1
			InventoryText.Font = Enum.Font.ArialBold
			InventoryText.FontSize = Enum.FontSize.Size18
			InventoryText.Position = UDim2.new(0,-7,0,-7)
			InventoryText.Size = UDim2.new(1,14,1,14)
			InventoryText.Text = "Gear"
			InventoryText.TextColor3 = Color3.new(1,1,1)
			InventoryText.Parent = InventoryButton
			
		local closeButton = Instance.new("TextButton")
		closeButton.RobloxLocked = true
		closeButton.Name = "CloseButton"
		closeButton.Font = Enum.Font.ArialBold
		closeButton.FontSize = Enum.FontSize.Size24
		closeButton.Position = UDim2.new(1,-33,0,2)
		closeButton.Size = UDim2.new(0,30,0,30)
		closeButton.Style = Enum.ButtonStyle.RobloxButton
		closeButton.Text = "X"
		closeButton.TextColor3 = Color3.new(1,1,1)
		closeButton.Parent = Tabs
	
	local Gear = Instance.new("Frame")
	Gear.Name = "Gear"
	Gear.RobloxLocked = true
	Gear.BackgroundTransparency = 1
	Gear.Size  = UDim2.new(1,0,1,0)
	Gear.Parent = Backpack

		-- Gear Children
		local GearGrid = Instance.new("Frame")
		GearGrid.RobloxLocked = true
		GearGrid.Name = "GearGrid"
		GearGrid.Size = UDim2.new(0.69,0,1,0)
		GearGrid.Style = Enum.FrameStyle.RobloxSquare
		GearGrid.Parent = Gear
		
			-- GearGrid Children
			local ResetFrame = Instance.new("Frame")
			ResetFrame.RobloxLocked = true
			ResetFrame.Name = "ResetFrame"
			ResetFrame.Visible = false
			ResetFrame.BackgroundTransparency = 1
			ResetFrame.Size = UDim2.new(0,32,0,64)
			ResetFrame.Parent = GearGrid
			
				-- ResetFrame Children
				local ResetImageLabel = Instance.new("ImageLabel")
				ResetImageLabel.RobloxLocked = true
				ResetImageLabel.Name = "ResetImageLabel"
				ResetImageLabel.Image = "rbxasset://textures/ui/ResetIcon.png"
				ResetImageLabel.BackgroundTransparency = 1
				ResetImageLabel.Position = UDim2.new(0,0,0,-12)
				ResetImageLabel.Size = UDim2.new(0.8,0,0.79,0)
				ResetImageLabel.ZIndex = 2
				ResetImageLabel.Parent = ResetFrame
				
				local ResetButtonBorder = Instance.new("TextButton")
				ResetButtonBorder.RobloxLocked = true
				ResetButtonBorder.Name = "ResetButtonBorder"
				ResetButtonBorder.Position = UDim2.new(0,-3,0,-7)
				ResetButtonBorder.Size = UDim2.new(1,0,0.64,0)
				ResetButtonBorder.Style = Enum.ButtonStyle.RobloxButton
				ResetButtonBorder.Text = ""
				ResetButtonBorder.Parent = ResetFrame
				
				
			local SearchFrame = Instance.new("Frame")
			SearchFrame.RobloxLocked = true
			SearchFrame.Name = "SearchFrame"
			SearchFrame.BackgroundTransparency = 1
			SearchFrame.Position = UDim2.new(1,-150,0,0)
			SearchFrame.Size = UDim2.new(0,150,0,25)
			SearchFrame.Parent = GearGrid
			
				-- SearchFrame Children
				local SearchButton = Instance.new("ImageButton")
				SearchButton.RobloxLocked = true
				SearchButton.Name = "SearchButton"
				SearchButton.Size = UDim2.new(0,25,0,25)
				SearchButton.BackgroundTransparency = 1
				SearchButton.Image = "rbxasset://textures/ui/SearchIcon.png"
				SearchButton.Parent = SearchFrame
				
				local SearchBoxFrame = Instance.new("TextButton")
				SearchBoxFrame.RobloxLocked = true
				SearchBoxFrame.Position = UDim2.new(0,26,0,0)
				SearchBoxFrame.Size = UDim2.new(0,121,0,25)
				SearchBoxFrame.Name = "SearchBoxFrame"
				SearchBoxFrame.Text = ""
				SearchBoxFrame.Style = Enum.ButtonStyle.RobloxButton
				SearchBoxFrame.Parent = SearchFrame
				
					-- SearchBoxFrame Children
					local SearchBox = Instance.new("TextBox")
					SearchBox.RobloxLocked = true
					SearchBox.Name = "SearchBox"
					SearchBox.BackgroundTransparency = 1
					SearchBox.Font = Enum.Font.ArialBold
					SearchBox.FontSize = Enum.FontSize.Size12
					SearchBox.Position = UDim2.new(0,-5,0,-5)
					SearchBox.Size = UDim2.new(1,10,1,10)
					SearchBox.TextColor3 = Color3.new(1,1,1)
					SearchBox.TextXAlignment = Enum.TextXAlignment.Left
					SearchBox.ZIndex = 2
					SearchBox.TextWrap = true
					SearchBox.Text = "Search..."
					SearchBox.Parent = SearchBoxFrame
			
			local GearButton = Instance.new("ImageButton")
			GearButton.RobloxLocked = true
			GearButton.Visible = false
			GearButton.Name = "GearButton"
			GearButton.Size = UDim2.new(0,64,0,64)
			GearButton.Style = Enum.ButtonStyle.RobloxButton
			GearButton.Parent = GearGrid

				-- GearButton Children
				local GearReference = Instance.new("ObjectValue")
				GearReference.RobloxLocked = true
				GearReference.Name = "GearReference"
				GearReference.Parent = GearButton
				
				local GreyOutButton = Instance.new("Frame")
				GreyOutButton.RobloxLocked = true
				GreyOutButton.Name = "GreyOutButton"
				GreyOutButton.BackgroundTransparency = 0.5
				GreyOutButton.Size = UDim2.new(1,0,1,0)
				GreyOutButton.Active = true
				GreyOutButton.Visible = false
				GreyOutButton.ZIndex = 3
				GreyOutButton.Parent = GearButton
				
				local GearText = Instance.new("TextLabel")
				GearText.RobloxLocked = true
				GearText.Name = "GearText"
				GearText.BackgroundTransparency = 1
				GearText.Font = Enum.Font.Arial
				GearText.FontSize = Enum.FontSize.Size14
				GearText.Position = UDim2.new(0,-8,0,-8)
				GearText.Size = UDim2.new(1,16,1,16)
				GearText.Text = ""
				GearText.ZIndex = 2
				GearText.TextColor3 = Color3.new(1,1,1)
				GearText.TextWrap = true
				GearText.Parent = GearButton

		local GearGridScrollingArea = Instance.new("Frame")
		GearGridScrollingArea.RobloxLocked = true
		GearGridScrollingArea.Name = "GearGridScrollingArea"
		GearGridScrollingArea.Position = UDim2.new(0.7,0,0,0)
		GearGridScrollingArea.Size = UDim2.new(0,17,1,0)
		GearGridScrollingArea.BackgroundTransparency = 1
		GearGridScrollingArea.Parent = Gear

		local GearLoadouts = Instance.new("Frame")
		GearLoadouts.RobloxLocked = true
		GearLoadouts.Name = "GearLoadouts"
		GearLoadouts.BackgroundTransparency = 1
		GearLoadouts.Position = UDim2.new(0.7,23,0.5,1)
		GearLoadouts.Size = UDim2.new(0.3,-23,0.5,-1)
		GearLoadouts.Parent = Gear
		GearLoadouts.Visible = false
		
			-- GearLoadouts Children
			local GearLoadoutsHeader = Instance.new("Frame")
			GearLoadoutsHeader.RobloxLocked = true
			GearLoadoutsHeader.Name = "GearLoadoutsHeader"
			GearLoadoutsHeader.BackgroundColor3 = Color3.new(0,0,0)
			GearLoadoutsHeader.BackgroundTransparency = 0.2
			GearLoadoutsHeader.BorderColor3 = Color3.new(1,0,0)
			GearLoadoutsHeader.Size = UDim2.new(1,2,0.15,-1)
			GearLoadoutsHeader.Parent = GearLoadouts

				-- GearLoadoutsHeader Children
				local LoadoutsHeaderText = Instance.new("TextLabel")
				LoadoutsHeaderText.RobloxLocked = true
				LoadoutsHeaderText.Name = "LoadoutsHeaderText"
				LoadoutsHeaderText.BackgroundTransparency = 1
				LoadoutsHeaderText.Font = Enum.Font.ArialBold
				LoadoutsHeaderText.FontSize = Enum.FontSize.Size18
				LoadoutsHeaderText.Size = UDim2.new(1,0,1,0)
				LoadoutsHeaderText.Text = "Loadouts"
				LoadoutsHeaderText.TextColor3 = Color3.new(1,1,1)
				LoadoutsHeaderText.Parent = GearLoadoutsHeader
	
				local GearLoadoutsScrollingArea = GearGridScrollingArea:clone()
				GearLoadoutsScrollingArea.RobloxLocked = true
				GearLoadoutsScrollingArea.Name = "GearLoadoutsScrollingArea"
				GearLoadoutsScrollingArea.Position = UDim2.new(1,-15,0.15,2)
				GearLoadoutsScrollingArea.Size = UDim2.new(0,17,0.85,-2)
				GearLoadoutsScrollingArea.Parent = GearLoadouts

				local LoadoutsList = Instance.new("Frame")
				LoadoutsList.RobloxLocked = true
				LoadoutsList.Name = "LoadoutsList"
				LoadoutsList.Position = UDim2.new(0,0,0.15,2)
				LoadoutsList.Size = UDim2.new(1,-17,0.85,-2)
				LoadoutsList.Style = Enum.FrameStyle.RobloxSquare
				LoadoutsList.Parent = GearLoadouts


		local GearPreview = Instance.new("Frame")
		GearPreview.RobloxLocked = true
		GearPreview.Name = "GearPreview"
		GearPreview.Position = UDim2.new(0.7,23,0,0)
		GearPreview.Size = UDim2.new(0.3,-23,0.5,-1)
		GearPreview.Style = Enum.FrameStyle.RobloxRound
		GearPreview.Parent = Gear
		
			-- GearPreview Children
			local GearStats = Instance.new("Frame")
			GearStats.RobloxLocked = true
			GearStats.Name = "GearStats"
			GearStats.BackgroundTransparency = 1
			GearStats.Position = UDim2.new(0,0,0.75,0)
			GearStats.Size = UDim2.new(1,0,0.25,0)
			GearStats.Parent = GearPreview
				
				-- GearStats Children
				local GearName = Instance.new("TextLabel")
				GearName.RobloxLocked = true
				GearName.Name = "GearName"
				GearName.BackgroundTransparency = 1
				GearName.Font = Enum.Font.ArialBold
				GearName.FontSize = Enum.FontSize.Size18
				GearName.Position = UDim2.new(0,-3,0,0)
				GearName.Size = UDim2.new(1,6,1,5)
				GearName.Text = ""
				GearName.TextColor3 = Color3.new(1,1,1)
				GearName.TextWrap = true
				GearName.Parent = GearStats
				
			local GearImage = Instance.new("ImageLabel")
			GearImage.RobloxLocked = true
			GearImage.Name = "GearImage"
			GearImage.Image = ""
			GearImage.BackgroundTransparency = 1
			GearImage.Position = UDim2.new(0.125,0,0,0)
			GearImage.Size = UDim2.new(0.75,0,0.75,0)
			GearImage.Parent = GearPreview
			
				--GearImage Children
				local GearIcons = Instance.new("Frame")
				GearIcons.BackgroundColor3 = Color3.new(0,0,0)
				GearIcons.BackgroundTransparency = 0.5
				GearIcons.BorderSizePixel = 0
				GearIcons.RobloxLocked = true
				GearIcons.Name = "GearIcons"
				GearIcons.Position = UDim2.new(0.4,2,0.85,-2)
				GearIcons.Size = UDim2.new(0.6,0,0.15,0)
				GearIcons.Visible = false
				GearIcons.Parent = GearImage
				
					-- GearIcons Children
					local GenreImage = Instance.new("ImageLabel")
					GenreImage.RobloxLocked = true
					GenreImage.Name = "GenreImage"
					GenreImage.BackgroundColor3 = Color3.new(102/255,153/255,1)
					GenreImage.BackgroundTransparency = 0.5
					GenreImage.BorderSizePixel = 0
					GenreImage.Size = UDim2.new(0.25,0,1,0)
					GenreImage.Parent = GearIcons
					
					local AttributeOneImage = GenreImage:clone()
					AttributeOneImage.RobloxLocked = true
					AttributeOneImage.Name = "AttributeOneImage"
					AttributeOneImage.BackgroundColor3 = Color3.new(1,51/255,0)
					AttributeOneImage.Position = UDim2.new(0.25,0,0,0)
					AttributeOneImage.Parent = GearIcons
					
					local AttributeTwoImage = GenreImage:clone()
					AttributeTwoImage.RobloxLocked = true
					AttributeTwoImage.Name = "AttributeTwoImage"
					AttributeTwoImage.BackgroundColor3 = Color3.new(153/255,1,153/255)
					AttributeTwoImage.Position = UDim2.new(0.5,0,0,0)
					AttributeTwoImage.Parent = GearIcons
					
					local AttributeThreeImage = GenreImage:clone()
					AttributeThreeImage.RobloxLocked = true
					AttributeThreeImage.Name = "AttributeThreeImage"
					AttributeThreeImage.BackgroundColor3 = Color3.new(0,0.5,0.5)
					AttributeThreeImage.Position = UDim2.new(0.75,0,0,0)
					AttributeThreeImage.Parent = GearIcons
					

-- Backpack Resizer (handles all backpack resizing junk)
--game:GetService("ScriptContext"):AddCoreScript(53878053,Backpack,"BackpackResizer")
dofile("rbxasset://scripts\\cores\\BackpackResizer.lua")

end)

-- RBXGUI START --
local RbxGuiLib = {}

local function ScopedConnect(parentInstance, instance, event, signalFunc, syncFunc, removeFunc)
	local eventConnection = nil

	--Connection on parentInstance is scoped by parentInstance (when destroyed, it goes away)
	local tryConnect = function()
		if game:IsAncestorOf(parentInstance) then
			--Entering the world, make sure we are connected/synced
			if not eventConnection then
				eventConnection = instance[event]:connect(signalFunc)
				if syncFunc then syncFunc() end
			end
		else
			--Probably leaving the world, so disconnect for now
			if eventConnection then
				eventConnection:disconnect()
				if removeFunc then removeFunc() end
			end
		end
	end

	--Hook it up to ancestryChanged signal
	local connection = parentInstance.AncestryChanged:connect(tryConnect)
	
	--Now connect us if we're already in the world
	tryConnect()
	
	return connection
end

local function CreateButtons(frame, buttons, yPos, ySize)
	local buttonNum = 1
	local buttonObjs = {}
	for i, obj in ipairs(buttons) do 
		local button = Instance.new("TextButton")
		button.Name = "Button" .. buttonNum
		button.Font = Enum.Font.Arial
		button.FontSize = Enum.FontSize.Size18
		button.AutoButtonColor = true
		button.Style = Enum.ButtonStyle.RobloxButtonDefault 
		button.Text = obj.Text
		button.TextColor3 = Color3.new(1,1,1)
		button.MouseButton1Click:connect(obj.Function)
		button.Parent = frame
		buttonObjs[buttonNum] = button

		buttonNum = buttonNum + 1
	end
	local numButtons = buttonNum-1

	if numButtons == 1 then
		frame.Button1.Position = UDim2.new(0.35, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.4,0,ySize.Scale, ySize.Offset)
	elseif numButtons == 2 then
		frame.Button1.Position = UDim2.new(0.1, 0, yPos.Scale, yPos.Offset)
		frame.Button1.Size = UDim2.new(.8/3,0, ySize.Scale, ySize.Offset)

		frame.Button2.Position = UDim2.new(0.55, 0, yPos.Scale, yPos.Offset)
		frame.Button2.Size = UDim2.new(.35,0, ySize.Scale, ySize.Offset)
	elseif numButtons >= 3 then
		local spacing = .1 / numButtons
		local buttonSize = .9 / numButtons

		buttonNum = 1
		while buttonNum <= numButtons do
			buttonObjs[buttonNum].Position = UDim2.new(spacing*buttonNum + (buttonNum-1) * buttonSize, 0, yPos.Scale, yPos.Offset)
			buttonObjs[buttonNum].Size = UDim2.new(buttonSize, 0, ySize.Scale, ySize.Offset)
			buttonNum = buttonNum + 1
		end
	end
end

local function setSliderPos(newAbsPosX,slider,sliderPosition,bar,steps)

	local newStep = steps - 1 --otherwise we really get one more step than we want
	
	local relativePosX = math.min(1, math.max(0, (newAbsPosX - bar.AbsolutePosition.X) / bar.AbsoluteSize.X ) )
	local wholeNum, remainder = math.modf(relativePosX * newStep)
	if remainder > 0.5 then
		wholeNum = wholeNum + 1
	end
	relativePosX = wholeNum/newStep

	local result = math.ceil(relativePosX * newStep)
	if sliderPosition.Value ~= (result + 1) then --onky update if we moved a step
		sliderPosition.Value = result + 1
		
		if relativePosX == 1 then
			slider.Position = UDim2.new(1,-slider.AbsoluteSize.X,slider.Position.Y.Scale,slider.Position.Y.Offset)
		else
			slider.Position = UDim2.new(relativePosX,0,slider.Position.Y.Scale,slider.Position.Y.Offset)
		end
	end
	
end

local function cancelSlide(areaSoak)
	areaSoak.Visible = false
	if areaSoakMouseMoveCon then areaSoakMouseMoveCon:disconnect() end
end

RbxGuiLib.CreateStyledMessageDialog = function(title, message, style, buttons)
	local frame = Instance.new("Frame")
	frame.Size = UDim2.new(0.5, 0, 0, 165)
	frame.Position = UDim2.new(0.25, 0, 0.5, -72.5)
	frame.Name = "MessageDialog"
	frame.Active = true
	frame.Style = Enum.FrameStyle.RobloxRound	
	
	local styleImage = Instance.new("ImageLabel")
	styleImage.Name = "StyleImage"
	styleImage.BackgroundTransparency = 1
	styleImage.Position = UDim2.new(0,5,0,15)
	if style == "error" or style == "Error" then
		styleImage.Size = UDim2.new(0, 71, 0, 71)
		styleImage.Image = "rbxasset://textures/ui/Error.png"
	elseif style == "notify" or style == "Notify" then
		styleImage.Size = UDim2.new(0, 71, 0, 71)
		styleImage.Image = "rbxasset://textures/ui/Notify.png"
	elseif style == "confirm" or style == "Confirm" then
		styleImage.Size = UDim2.new(0, 74, 0, 76)
		styleImage.Image = "rbxasset://textures/ui/Confirm.png"
	else
		return RbxGuiLib.CreateMessageDialog(title,message,buttons)
	end
	styleImage.Parent = frame
	
	local titleLabel = Instance.new("TextLabel")
	titleLabel.Name = "Title"
	titleLabel.Text = title
	titleLabel.BackgroundTransparency = 1
	titleLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	titleLabel.Position = UDim2.new(0, 80, 0, 0)
	titleLabel.Size = UDim2.new(1, -80, 0, 40)
	titleLabel.Font = Enum.Font.ArialBold
	titleLabel.FontSize = Enum.FontSize.Size36
	titleLabel.TextXAlignment = Enum.TextXAlignment.Center
	titleLabel.TextYAlignment = Enum.TextYAlignment.Center
	titleLabel.Parent = frame

	local messageLabel = Instance.new("TextLabel")
	messageLabel.Name = "Message"
	messageLabel.Text = message
	messageLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	messageLabel.Position = UDim2.new(0.025, 80, 0, 45)
	messageLabel.Size = UDim2.new(0.95, -80, 0, 55)
	messageLabel.BackgroundTransparency = 1
	messageLabel.Font = Enum.Font.Arial
	messageLabel.FontSize = Enum.FontSize.Size18
	messageLabel.TextWrap = true
	messageLabel.TextXAlignment = Enum.TextXAlignment.Left
	messageLabel.TextYAlignment = Enum.TextYAlignment.Top
	messageLabel.Parent = frame

	CreateButtons(frame, buttons, UDim.new(0, 105), UDim.new(0, 40) )

	return frame
end

RbxGuiLib.CreateMessageDialog = function(title, message, buttons)
	local frame = Instance.new("Frame")
	frame.Size = UDim2.new(0.5, 0, 0.5, 0)
	frame.Position = UDim2.new(0.25, 0, 0.25, 0)
	frame.Name = "MessageDialog"
	frame.Active = true
	frame.Style = Enum.FrameStyle.RobloxRound

	local titleLabel = Instance.new("TextLabel")
	titleLabel.Name = "Title"
	titleLabel.Text = title
	titleLabel.BackgroundTransparency = 1
	titleLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	titleLabel.Position = UDim2.new(0, 0, 0, 0)
	titleLabel.Size = UDim2.new(1, 0, 0.15, 0)
	titleLabel.Font = Enum.Font.ArialBold
	titleLabel.FontSize = Enum.FontSize.Size36
	titleLabel.TextXAlignment = Enum.TextXAlignment.Center
	titleLabel.TextYAlignment = Enum.TextYAlignment.Center
	titleLabel.Parent = frame

	local messageLabel = Instance.new("TextLabel")
	messageLabel.Name = "Message"
	messageLabel.Text = message
	messageLabel.TextColor3 = Color3.new(221/255,221/255,221/255)
	messageLabel.Position = UDim2.new(0.025, 0, 0.175, 0)
	messageLabel.Size = UDim2.new(0.95, 0, .55, 0)
	messageLabel.BackgroundTransparency = 1
	messageLabel.Font = Enum.Font.Arial
	messageLabel.FontSize = Enum.FontSize.Size18
	messageLabel.TextWrap = true
	messageLabel.TextXAlignment = Enum.TextXAlignment.Left
	messageLabel.TextYAlignment = Enum.TextYAlignment.Top
	messageLabel.Parent = frame

	CreateButtons(frame, buttons, UDim.new(0.8,0), UDim.new(0.15, 0))

	return frame
end

RbxGuiLib.CreateDropDownMenu = function(items, onSelect, forRoblox)
	local width = UDim.new(0, 100)
	local height = UDim.new(0, 32)

	local xPos = 0.055
	local frame = Instance.new("Frame")
	frame.Name = "DropDownMenu"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(width, height)

	local dropDownMenu = Instance.new("TextButton")
	dropDownMenu.Name = "DropDownMenuButton"
	dropDownMenu.TextWrap = true
	dropDownMenu.TextColor3 = Color3.new(1,1,1)
	dropDownMenu.Text = "Choose One"
	dropDownMenu.Font = Enum.Font.ArialBold
	dropDownMenu.FontSize = Enum.FontSize.Size18
	dropDownMenu.TextXAlignment = Enum.TextXAlignment.Left
	dropDownMenu.TextYAlignment = Enum.TextYAlignment.Center
	dropDownMenu.BackgroundTransparency = 1
	dropDownMenu.AutoButtonColor = true
	dropDownMenu.Style = Enum.ButtonStyle.RobloxButton
	dropDownMenu.Size = UDim2.new(1,0,1,0)
	dropDownMenu.Parent = frame
	dropDownMenu.ZIndex = 2

	local dropDownIcon = Instance.new("ImageLabel")
	dropDownIcon.Name = "Icon"
	dropDownIcon.Active = false
	dropDownIcon.Image = "rbxasset://textures/ui/DropDown.png"
	dropDownIcon.BackgroundTransparency = 1
	dropDownIcon.Size = UDim2.new(0,11,0,6)
	dropDownIcon.Position = UDim2.new(1,-11,0.5, -2)
	dropDownIcon.Parent = dropDownMenu
	dropDownIcon.ZIndex = 2
	
	local itemCount = #items
	local dropDownItemCount = #items
	local useScrollButtons = false
	if dropDownItemCount > 6 then
		useScrollButtons = true
		dropDownItemCount = 6
	end
	
	local droppedDownMenu = Instance.new("TextButton")
	droppedDownMenu.Name = "List"
	droppedDownMenu.Text = ""
	droppedDownMenu.BackgroundTransparency = 1
	--droppedDownMenu.AutoButtonColor = true
	droppedDownMenu.Style = Enum.ButtonStyle.RobloxButton
	droppedDownMenu.Visible = false
	droppedDownMenu.Active = true	--Blocks clicks
	droppedDownMenu.Position = UDim2.new(0,0,0,0)
	droppedDownMenu.Size = UDim2.new(1,0, (1 + dropDownItemCount)*.8, 0)
	droppedDownMenu.Parent = frame
	droppedDownMenu.ZIndex = 2

	local choiceButton = Instance.new("TextButton")
	choiceButton.Name = "ChoiceButton"
	choiceButton.BackgroundTransparency = 1
	choiceButton.BorderSizePixel = 0
	choiceButton.Text = "ReplaceMe"
	choiceButton.TextColor3 = Color3.new(1,1,1)
	choiceButton.TextXAlignment = Enum.TextXAlignment.Left
	choiceButton.TextYAlignment = Enum.TextYAlignment.Center
	choiceButton.BackgroundColor3 = Color3.new(1, 1, 1)
	choiceButton.Font = Enum.Font.Arial
	choiceButton.FontSize = Enum.FontSize.Size18
	if useScrollButtons then
		choiceButton.Size = UDim2.new(1,-13, .8/((dropDownItemCount + 1)*.8),0) 
	else
		choiceButton.Size = UDim2.new(1, 0, .8/((dropDownItemCount + 1)*.8),0) 
	end
	choiceButton.TextWrap = true
	choiceButton.ZIndex = 2

	local dropDownSelected = false

	local scrollUpButton 
	local scrollDownButton
	local scrollMouseCount = 0

	local setZIndex = function(baseZIndex)
		droppedDownMenu.ZIndex = baseZIndex +1
		if scrollUpButton then
			scrollUpButton.ZIndex = baseZIndex + 3
		end
		if scrollDownButton then
			scrollDownButton.ZIndex = baseZIndex + 3
		end
		
		local children = droppedDownMenu:GetChildren()
		if children then
			for i, child in ipairs(children) do
				if child.Name == "ChoiceButton" then
					child.ZIndex = baseZIndex + 2
				elseif child.Name == "ClickCaptureButton" then
					child.ZIndex = baseZIndex
				end
			end
		end
	end

	local scrollBarPosition = 1
	local updateScroll = function()
		if scrollUpButton then
			scrollUpButton.Active = scrollBarPosition > 1 
		end
		if scrollDownButton then
			scrollDownButton.Active = scrollBarPosition + dropDownItemCount <= itemCount 
		end

		local children = droppedDownMenu:GetChildren()
		if not children then return end

		local childNum = 1			
		for i, obj in ipairs(children) do
			if obj.Name == "ChoiceButton" then
				if childNum < scrollBarPosition or childNum >= scrollBarPosition + dropDownItemCount then
					obj.Visible = false
				else
					obj.Position = UDim2.new(0,0,((childNum-scrollBarPosition+1)*.8)/((dropDownItemCount+1)*.8),0)
					obj.Visible = true
				end
				obj.TextColor3 = Color3.new(1,1,1)
				obj.BackgroundTransparency = 1

				childNum = childNum + 1
			end
		end
	end
	local toggleVisibility = function()
		dropDownSelected = not dropDownSelected

		dropDownMenu.Visible = not dropDownSelected
		droppedDownMenu.Visible = dropDownSelected
		if dropDownSelected then
			setZIndex(4)
		else
			setZIndex(2)
		end
		if useScrollButtons then
			updateScroll()
		end
	end
	droppedDownMenu.MouseButton1Click:connect(toggleVisibility)

	local updateSelection = function(text)
		local foundItem = false
		local children = droppedDownMenu:GetChildren()
		local childNum = 1
		if children then
			for i, obj in ipairs(children) do
				if obj.Name == "ChoiceButton" then
					if obj.Text == text then
						obj.Font = Enum.Font.ArialBold
						foundItem = true			
						scrollBarPosition = childNum
					else
						obj.Font = Enum.Font.Arial
					end
					childNum = childNum + 1
				end
			end
		end
		if not text then
			dropDownMenu.Text = "Choose One"
			scrollBarPosition = 1
		else
			if not foundItem then
				error("Invalid Selection Update -- " .. text)
			end

			if scrollBarPosition + dropDownItemCount > itemCount + 1 then
				scrollBarPosition = itemCount - dropDownItemCount + 1
			end

			dropDownMenu.Text = text
		end
	end
	
	local function scrollDown()
		if scrollBarPosition + dropDownItemCount <= itemCount then
			scrollBarPosition = scrollBarPosition + 1
			updateScroll()
			return true
		end
		return false
	end
	local function scrollUp()
		if scrollBarPosition > 1 then
			scrollBarPosition = scrollBarPosition - 1
			updateScroll()
			return true
		end
		return false
	end
	
	if useScrollButtons then
		--Make some scroll buttons
		scrollUpButton = Instance.new("ImageButton")
		scrollUpButton.Name = "ScrollUpButton"
		scrollUpButton.BackgroundTransparency = 1
		scrollUpButton.Image = "rbxasset://textures/ui/scrollbuttonUp.png"
		scrollUpButton.Size = UDim2.new(0,17,0,17) 
		scrollUpButton.Position = UDim2.new(1,-11,(1*.8)/((dropDownItemCount+1)*.8),0)
		scrollUpButton.MouseButton1Click:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollUpButton.MouseLeave:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollUpButton.MouseButton1Down:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
	
				scrollUp()
				local val = scrollMouseCount
				wait(0.5)
				while val == scrollMouseCount do
					if scrollUp() == false then
						break
					end
					wait(0.1)
				end				
			end)

		scrollUpButton.Parent = droppedDownMenu

		scrollDownButton = Instance.new("ImageButton")
		scrollDownButton.Name = "ScrollDownButton"
		scrollDownButton.BackgroundTransparency = 1
		scrollDownButton.Image = "rbxasset://textures/ui/scrollbuttonDown.png"
		scrollDownButton.Size = UDim2.new(0,17,0,17) 
		scrollDownButton.Position = UDim2.new(1,-11,1,-11)
		scrollDownButton.Parent = droppedDownMenu
		scrollDownButton.MouseButton1Click:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollDownButton.MouseLeave:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1
			end)
		scrollDownButton.MouseButton1Down:connect(
			function()
				scrollMouseCount = scrollMouseCount + 1

				scrollDown()
				local val = scrollMouseCount
				wait(0.5)
				while val == scrollMouseCount do
					if scrollDown() == false then
						break
					end
					wait(0.1)
				end				
			end)	

		local scrollbar = Instance.new("ImageLabel")
		scrollbar.Name = "ScrollBar"
		scrollbar.Image = "rbxasset://textures/ui/scrollbar.png"
		scrollbar.BackgroundTransparency = 1
		scrollbar.Size = UDim2.new(0, 18, (dropDownItemCount*.8)/((dropDownItemCount+1)*.8), -(17) - 11 - 4)
		scrollbar.Position = UDim2.new(1,-11,(1*.8)/((dropDownItemCount+1)*.8),17+2)
		scrollbar.Parent = droppedDownMenu
	end

	for i,item in ipairs(items) do
		-- needed to maintain local scope for items in event listeners below
		local button = choiceButton:clone()
		if forRoblox then
			button.RobloxLocked = true
		end		
		button.Text = item
		button.Parent = droppedDownMenu
		button.MouseButton1Click:connect(function()
			--Remove Highlight
			button.TextColor3 = Color3.new(1,1,1)
			button.BackgroundTransparency = 1

			updateSelection(item)
			onSelect(item)

			toggleVisibility()
		end)
		button.MouseEnter:connect(function()
			--Add Highlight	
			button.TextColor3 = Color3.new(0,0,0)
			button.BackgroundTransparency = 0
		end)

		button.MouseLeave:connect(function()
			--Remove Highlight
			button.TextColor3 = Color3.new(1,1,1)
			button.BackgroundTransparency = 1
		end)
	end

	--This does the initial layout of the buttons	
	updateScroll()

	local bigFakeButton = Instance.new("TextButton")
	bigFakeButton.BackgroundTransparency = 1
	bigFakeButton.Name = "ClickCaptureButton"
	bigFakeButton.Size = UDim2.new(0, 4000, 0, 3000)
	bigFakeButton.Position = UDim2.new(0, -2000, 0, -1500)
	bigFakeButton.ZIndex = 1
	bigFakeButton.Text = ""
	bigFakeButton.Parent = droppedDownMenu
	bigFakeButton.MouseButton1Click:connect(toggleVisibility)

	dropDownMenu.MouseButton1Click:connect(toggleVisibility)
	return frame, updateSelection
end

RbxGuiLib.CreatePropertyDropDownMenu = function(instance, property, enum)

	local items = enum:GetEnumItems()
	local names = {}
	local nameToItem = {}
	for i,obj in ipairs(items) do
		names[i] = obj.Name
		nameToItem[obj.Name] = obj
	end

	local frame
	local updateSelection
	frame, updateSelection = RbxGuiLib.CreateDropDownMenu(names, function(text) instance[property] = nameToItem[text] end)

	ScopedConnect(frame, instance, "Changed", 
		function(prop)
			if prop == property then
				updateSelection(instance[property].Name)
			end
		end,
		function()
			updateSelection(instance[property].Name)
		end)

	return frame
end

RbxGuiLib.GetFontHeight = function(font, fontSize)
	if font == nil or fontSize == nil then
		error("Font and FontSize must be non-nil")
	end

	if font == Enum.Font.Legacy then
		if fontSize == Enum.FontSize.Size8 then
			return 12
		elseif fontSize == Enum.FontSize.Size9 then
			return 14
		elseif fontSize == Enum.FontSize.Size10 then
			return 15
		elseif fontSize == Enum.FontSize.Size11 then
			return 17
		elseif fontSize == Enum.FontSize.Size12 then
			return 18
		elseif fontSize == Enum.FontSize.Size14 then
			return 21
		elseif fontSize == Enum.FontSize.Size18 then
			return 27
		elseif fontSize == Enum.FontSize.Size24 then
			return 36
		elseif fontSize == Enum.FontSize.Size36 then
			return 54
		elseif fontSize == Enum.FontSize.Size48 then
			return 72
		else
			error("Unknown FontSize")
		end
	elseif font == Enum.Font.Arial or font == Enum.Font.ArialBold then
		if fontSize == Enum.FontSize.Size8 then
			return 8
		elseif fontSize == Enum.FontSize.Size9 then
			return 9
		elseif fontSize == Enum.FontSize.Size10 then
			return 10
		elseif fontSize == Enum.FontSize.Size11 then
			return 11
		elseif fontSize == Enum.FontSize.Size12 then
			return 12
		elseif fontSize == Enum.FontSize.Size14 then
			return 14
		elseif fontSize == Enum.FontSize.Size18 then
			return 18
		elseif fontSize == Enum.FontSize.Size24 then
			return 24
		elseif fontSize == Enum.FontSize.Size36 then
			return 36
		elseif fontSize == Enum.FontSize.Size48 then
			return 48
		else
			error("Unknown FontSize")
		end
	else
		error("Unknown Font " .. font)
	end
end

local function layoutGuiObjectsHelper(frame, guiObjects, settingsTable)
	local totalPixels = frame.AbsoluteSize.Y
	local pixelsRemaining = frame.AbsoluteSize.Y
	for i, child in ipairs(guiObjects) do
		if child:IsA("TextLabel") or child:IsA("TextButton") then
			local isLabel = child:IsA("TextLabel")
			if isLabel then
				pixelsRemaining = pixelsRemaining - settingsTable["TextLabelPositionPadY"]
			else
				pixelsRemaining = pixelsRemaining - settingsTable["TextButtonPositionPadY"]
			end
			child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
			child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, pixelsRemaining)

			if child.TextFits and child.TextBounds.Y < pixelsRemaining then
				child.Visible = true
				if isLabel then
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.TextBounds.Y + settingsTable["TextLabelSizePadY"])
				else 
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.TextBounds.Y + settingsTable["TextButtonSizePadY"])
				end

				while not child.TextFits do
					child.Size = UDim2.new(child.Size.X.Scale, child.Size.X.Offset, 0, child.AbsoluteSize.Y + 1)
				end
				pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y		

				if isLabel then
					pixelsRemaining = pixelsRemaining - settingsTable["TextLabelPositionPadY"]
				else
					pixelsRemaining = pixelsRemaining - settingsTable["TextButtonPositionPadY"]
				end
			else
				child.Visible = false
				pixelsRemaining = -1
			end			

		else
			--GuiObject
			child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
			pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y
			child.Visible = (pixelsRemaining >= 0)
		end
	end
end

RbxGuiLib.LayoutGuiObjects = function(frame, guiObjects, settingsTable)
	if not frame:IsA("GuiObject") then
		error("Frame must be a GuiObject")
	end
	for i, child in ipairs(guiObjects) do
		if not child:IsA("GuiObject") then
			error("All elements that are layed out must be of type GuiObject")
		end
	end

	if not settingsTable then
		settingsTable = {}
	end

	if not settingsTable["TextLabelSizePadY"] then
		settingsTable["TextLabelSizePadY"] = 0
	end
	if not settingsTable["TextLabelPositionPadY"] then
		settingsTable["TextLabelPositionPadY"] = 0
	end
	if not settingsTable["TextButtonSizePadY"] then
		settingsTable["TextButtonSizePadY"] = 12
	end
	if not settingsTable["TextButtonPositionPadY"] then
		settingsTable["TextButtonPositionPadY"] = 2
	end

	--Wrapper frame takes care of styled objects
	local wrapperFrame = Instance.new("Frame")
	wrapperFrame.Name = "WrapperFrame"
	wrapperFrame.BackgroundTransparency = 1
	wrapperFrame.Size = UDim2.new(1,0,1,0)
	wrapperFrame.Parent = frame

	for i, child in ipairs(guiObjects) do
		child.Parent = wrapperFrame
	end

	local recalculate = function()
		wait()
		layoutGuiObjectsHelper(wrapperFrame, guiObjects, settingsTable)
	end
	
	frame.Changed:connect(
		function(prop)
			if prop == "AbsoluteSize" then
				--Wait a heartbeat for it to sync in
				recalculate()
			end
		end)
	frame.AncestryChanged:connect(recalculate)

	layoutGuiObjectsHelper(wrapperFrame, guiObjects, settingsTable)
end


RbxGuiLib.CreateSlider = function(steps,width,position)
	local sliderGui = Instance.new("Frame")
	sliderGui.Size = UDim2.new(1,0,1,0)
	sliderGui.BackgroundTransparency = 1
	sliderGui.Name = "SliderGui"
	
	local areaSoak = Instance.new("TextButton")
	areaSoak.Name = "AreaSoak"
	areaSoak.Text = ""
	areaSoak.BackgroundTransparency = 1
	areaSoak.Active = false
	areaSoak.Size = UDim2.new(1,0,1,0)
	areaSoak.Visible = false
	areaSoak.ZIndex = 4
	areaSoak.Parent = sliderGui
	
	local sliderPosition = Instance.new("IntValue")
	sliderPosition.Name = "SliderPosition"
	sliderPosition.Value = 0
	sliderPosition.Parent = sliderGui
	
	local id = math.random(1,100)
	
	local bar = Instance.new("Frame")
	bar.Name = "Bar"
	bar.BackgroundColor3 = Color3.new(0,0,0)
	if type(width) == "number" then
		bar.Size = UDim2.new(0,width,0,5)
	else
		bar.Size = UDim2.new(0,200,0,5)
	end
	bar.BorderColor3 = Color3.new(95/255,95/255,95/255)
	bar.ZIndex = 2
	bar.Parent = sliderGui
	
	if position["X"] and position["X"]["Scale"] and position["X"]["Offset"] and position["Y"] and position["Y"]["Scale"] and position["Y"]["Offset"] then
		bar.Position = position
	end
	
	local slider = Instance.new("ImageButton")
	slider.Name = "Slider"
	slider.BackgroundTransparency = 1
	slider.Image = "rbxasset://textures/ui/Slider.png"
	slider.Position = UDim2.new(0,0,0.5,-10)
	slider.Size = UDim2.new(0,20,0,20)
	slider.ZIndex = 3
	slider.Parent = bar
	
	local areaSoakMouseMoveCon = nil
	
	areaSoak.MouseLeave:connect(function()
		if areaSoak.Visible then
			cancelSlide(areaSoak)
		end
	end)
	areaSoak.MouseButton1Up:connect(function()
		if areaSoak.Visible then
			cancelSlide(areaSoak)
		end
	end)
	
	slider.MouseButton1Down:connect(function()
		areaSoak.Visible = true
		if areaSoakMouseMoveCon then areaSoakMouseMoveCon:disconnect() end
		areaSoakMouseMoveCon = areaSoak.MouseMoved:connect(function(x,y)
			setSliderPos(x,slider,sliderPosition,bar,steps)
		end)
	end)
	
	slider.MouseButton1Up:connect(function() cancelSlide(areaSoak) end)
	
	sliderPosition.Changed:connect(function(prop)
		sliderPosition.Value = math.min(steps, math.max(1,sliderPosition.Value))
		local relativePosX = (sliderPosition.Value) / steps
		if relativePosX >= 1 then
			slider.Position = UDim2.new(relativePosX,-20,slider.Position.Y.Scale,slider.Position.Y.Offset)
		else
			slider.Position = UDim2.new(relativePosX,0,slider.Position.Y.Scale,slider.Position.Y.Offset)
		end
	end)
	
	return sliderGui, sliderPosition

end


RbxGuiLib.CreateScrollingFrame = function(orderList,scrollStyle)
	local frame = Instance.new("Frame")
	frame.Name = "ScrollingFrame"
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(1,0,1,0)
	
	local scrollUpButton = Instance.new("ImageButton")
	scrollUpButton.Name = "ScrollUpButton"
	scrollUpButton.BackgroundTransparency = 1
	scrollUpButton.Image = "rbxasset://textures/ui/scrollbuttonUp.png"
	scrollUpButton.Size = UDim2.new(0,17,0,17) 

	
	local scrollDownButton = Instance.new("ImageButton")
	scrollDownButton.Name = "ScrollDownButton"
	scrollDownButton.BackgroundTransparency = 1
	scrollDownButton.Image = "rbxasset://textures/ui/scrollbuttonDown.png"
	scrollDownButton.Size = UDim2.new(0,17,0,17) 

	local style = "simple"
	if scrollStyle and tostring(scrollStyle) then
		style = scrollStyle
	end
	
	local scrollPosition = 1
	local rowSize = 1
	
	local layoutGridScrollBar = function()
		local guiObjects = {}
		if orderList then
			for i, child in ipairs(orderList) do
				if child.Parent == frame then
					table.insert(guiObjects, child)
				end
			end
		else
			local children = frame:GetChildren()
			if children then
				for i, child in ipairs(children) do 
					if child:IsA("GuiObject") then
						table.insert(guiObjects, child)
					end
				end
			end
		end
		if #guiObjects == 0 then
			scrollUpButton.Active = false
			scrollDownButton.Active = false
			scrollPosition = 1
			return
		end

		if scrollPosition > #guiObjects then
			scrollPosition = #guiObjects
		end
		
		local totalPixelsY = frame.AbsoluteSize.Y
		local pixelsRemainingY = frame.AbsoluteSize.Y
		
		local totalPixelsX  = frame.AbsoluteSize.X
		
		local xCounter = 0
		local rowSizeCounter = 0
		local setRowSize = true

		local pixelsBelowScrollbar = 0
		local pos = #guiObjects
		while pixelsBelowScrollbar < totalPixelsY and pos >= 1 do
			if pos >= scrollPosition then
				pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
			else
				xCounter = xCounter + guiObjects[pos].AbsoluteSize.X
				rowSizeCounter = rowSizeCounter + 1
				if xCounter >= totalPixelsX then
					if setRowSize then
						rowSize = rowSizeCounter - 1
						setRowSize = false
					end
					
					rowSizeCounter = 0
					xCounter = 0
					if pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y <= totalPixelsY then
						--It fits, so back up our scroll position
						pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
						if scrollPosition <= rowSize then
							scrollPosition = rowSize 
							break
						else
							--print("Backing up ScrollPosition from -- " ..scrollPosition)
							scrollPosition = scrollPosition - rowSize 
						end
					else
						break
					end
				end
			end
			pos = pos - 1
		end

		xCounter = 0
		--print("ScrollPosition = " .. scrollPosition)
		pos = scrollPosition
		rowSizeCounter = 0
		setRowSize = true
		local lastChildSize = 0
		
		local xOffset,yOffset = 0
		if guiObjects[1] then
			yOffset = math.ceil(math.floor(math.fmod(totalPixelsY,guiObjects[1].AbsoluteSize.X))/2)
			xOffset = math.ceil(math.floor(math.fmod(totalPixelsX,guiObjects[1].AbsoluteSize.Y))/2)
		end
		
		for i, child in ipairs(guiObjects) do
			if i < scrollPosition then
				--print("Hiding " .. child.Name)
				child.Visible = false
			else
				if pixelsRemainingY < 0 then
					--print("Out of Space " .. child.Name)
					child.Visible = false
				else
					--print("Laying out " .. child.Name)
					--GuiObject
					if setRowSize then rowSizeCounter = rowSizeCounter + 1 end
					if xCounter + child.AbsoluteSize.X >= totalPixelsX then
						if setRowSize then
							rowSize = rowSizeCounter - 1
							setRowSize = false
						end
						xCounter = 0
						pixelsRemainingY = pixelsRemainingY - child.AbsoluteSize.Y
					end
					child.Position = UDim2.new(child.Position.X.Scale,xCounter + xOffset, 0, totalPixelsY - pixelsRemainingY + yOffset)
					xCounter = xCounter + child.AbsoluteSize.X
					child.Visible = ((pixelsRemainingY - child.AbsoluteSize.Y) >= 0)
					lastChildSize = child.AbsoluteSize				
				end
			end
		end

		scrollUpButton.Active = (scrollPosition > 1)
		if lastChildSize == 0 then 
			scrollDownButton.Active = false
		else
			scrollDownButton.Active = ((pixelsRemainingY - lastChildSize.Y) < 0)
		end
	end


	local layoutSimpleScrollBar = function()
		local guiObjects = {}	
		
		if orderList then
			for i, child in ipairs(orderList) do
				if child.Parent == frame then
					table.insert(guiObjects, child)
				end
			end
		else
			local children = frame:GetChildren()
			if children then
				for i, child in ipairs(children) do 
					if child:IsA("GuiObject") then
						table.insert(guiObjects, child)
					end
				end
			end
		end
		if #guiObjects == 0 then
			scrollUpButton.Active = false
			scrollDownButton.Active = false
			scrollPosition = 1
			return
		end

		if scrollPosition > #guiObjects then
			scrollPosition = #guiObjects
		end
		
		local totalPixels = frame.AbsoluteSize.Y
		local pixelsRemaining = frame.AbsoluteSize.Y

		local pixelsBelowScrollbar = 0
		local pos = #guiObjects
		while pixelsBelowScrollbar < totalPixels and pos >= 1 do
			if pos >= scrollPosition then
				pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
			else
				if pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y <= totalPixels then
					--It fits, so back up our scroll position
					pixelsBelowScrollbar = pixelsBelowScrollbar + guiObjects[pos].AbsoluteSize.Y
					if scrollPosition <= 1 then
						scrollPosition = 1
						break
					else
						--print("Backing up ScrollPosition from -- " ..scrollPosition)
						scrollPosition = scrollPosition - 1
					end
				else
					break
				end
			end
			pos = pos - 1
		end

		--print("ScrollPosition = " .. scrollPosition)
		pos = scrollPosition
		for i, child in ipairs(guiObjects) do
			if i < scrollPosition then
				--print("Hiding " .. child.Name)
				child.Visible = false
			else
				if pixelsRemaining < 0 then
					--print("Out of Space " .. child.Name)
					child.Visible = false
				else
					--print("Laying out " .. child.Name)
					--GuiObject
					child.Position = UDim2.new(child.Position.X.Scale, child.Position.X.Offset, 0, totalPixels - pixelsRemaining)
					pixelsRemaining = pixelsRemaining - child.AbsoluteSize.Y
					child.Visible = (pixelsRemaining >= 0)				
				end
			end
		end
		scrollUpButton.Active = (scrollPosition > 1)
		scrollDownButton.Active = (pixelsRemaining < 0)
	end

	local reentrancyGuard = false
	local recalculate = function()
		if reentrancyGuard then
			return
		end
		reentrancyGuard = true
		wait()
		local success, err = nil
		if style == "grid" then
			success, err = pcall(function() layoutGridScrollBar(frame) end)
		elseif style == "simple" then
			success, err = pcall(function() layoutSimpleScrollBar(frame) end)
		end
		if not success then print(err) end

		reentrancyGuard = false
	end

	local scrollUp = function()
		if scrollUpButton.Active then
			scrollPosition = scrollPosition - rowSize
			recalculate()
		end
	end

	local scrollDown = function()
		if scrollDownButton.Active then
			scrollPosition = scrollPosition + rowSize
			recalculate()
		end
	end

	local scrollMouseCount = 0
	scrollUpButton.MouseButton1Click:connect(
		function()
			--print("Up-MouseButton1Click")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollUpButton.MouseLeave:connect(
		function()
			--print("Up-Leave")
			scrollMouseCount = scrollMouseCount + 1
		end)

	scrollUpButton.MouseButton1Down:connect(
		function()
			--print("Up-Down")
			scrollMouseCount = scrollMouseCount + 1

			scrollUp()
			local val = scrollMouseCount
			wait(0.5)
			while val == scrollMouseCount do
				if scrollUp() == false then
					break
				end
				wait(0.1)
			end				
		end)

	scrollDownButton.MouseButton1Click:connect(
		function()
			--print("Down-Click")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollDownButton.MouseLeave:connect(
		function()
			--print("Down-Leave")
			scrollMouseCount = scrollMouseCount + 1
		end)
	scrollDownButton.MouseButton1Down:connect(
		function()
			--print("Down-Down")
			scrollMouseCount = scrollMouseCount + 1

			scrollDown()
			local val = scrollMouseCount
			wait(0.5)
			while val == scrollMouseCount do
				if scrollDown() == false then
					break
				end
				wait(0.1)
			end				
		end)


	frame.ChildAdded:connect(function()
		recalculate()
	end)

	frame.ChildRemoved:connect(function()
		recalculate()
	end)
	
	frame.Changed:connect(
		function(prop)
			if prop == "AbsoluteSize" then
				--Wait a heartbeat for it to sync in
				recalculate()
			end
		end)
	frame.AncestryChanged:connect(recalculate)

	return frame, scrollUpButton, scrollDownButton, recalculate
end
local function binaryGrow(min, max, fits)
	if min > max then
		return min
	end
	local biggestLegal = min

	while min <= max do
		local mid = min + math.floor((max - min) / 2)
		if fits(mid) and (biggestLegal == nil or biggestLegal < mid) then
			biggestLegal = mid
			
			--Try growing
			min = mid + 1
		else
			--Doesn't fit, shrink
			max = mid - 1
		end
	end
	return biggestLegal
end


local function binaryShrink(min, max, fits)
	if min > max then
		return min
	end
	local smallestLegal = max

	while min <= max do
		local mid = min + math.floor((max - min) / 2)
		if fits(mid) and (smallestLegal == nil or smallestLegal > mid) then
			smallestLegal = mid
			
			--It fits, shrink
			max = mid - 1			
		else
			--Doesn't fit, grow
			min = mid + 1
		end
	end
	return smallestLegal
end


local function getGuiOwner(instance)
	while instance ~= nil do
		if instance:IsA("ScreenGui") or instance:IsA("BillboardGui")  then
			return instance
		end
		instance = instance.Parent
	end
	return nil
end

RbxGuiLib.AutoTruncateTextObject = function(textLabel)
	local text = textLabel.Text

	local fullLabel = textLabel:Clone()
	fullLabel.Name = "Full" .. textLabel.Name 
	fullLabel.BorderSizePixel = 0
	fullLabel.BackgroundTransparency = 0
	fullLabel.Text = text
	fullLabel.TextXAlignment = Enum.TextXAlignment.Center
	fullLabel.Position = UDim2.new(0,-3,0,0)
	fullLabel.Size = UDim2.new(0,100,1,0)
	fullLabel.Visible = false
	fullLabel.Parent = textLabel

	local shortText = nil
	local mouseEnterConnection = nil
	local mouseLeaveConnection= nil

	local checkForResize = function()
		if getGuiOwner(textLabel) == nil then
			return
		end
		textLabel.Text = text
		if textLabel.TextFits then 
			--Tear down the rollover if it is active
			if mouseEnterConnection then
				mouseEnterConnection:disconnect()
				mouseEnterConnection = nil
			end
			if mouseLeaveConnection then
				mouseLeaveConnection:disconnect()
				mouseLeaveConnection = nil
			end
		else
			local len = string.len(text)
			textLabel.Text = text .. "~"

			--Shrink the text
			local textSize = binaryGrow(0, len, 
				function(pos)
					if pos == 0 then
						textLabel.Text = "~"
					else
						textLabel.Text = string.sub(text, 1, pos) .. "~"
					end
					return textLabel.TextFits
				end)
			shortText = string.sub(text, 1, textSize) .. "~"
			textLabel.Text = shortText
			
			--Make sure the fullLabel fits
			if not fullLabel.TextFits then
				--Already too small, grow it really bit to start
				fullLabel.Size = UDim2.new(0, 10000, 1, 0)
			end
			
			--Okay, now try to binary shrink it back down
			local fullLabelSize = binaryShrink(textLabel.AbsoluteSize.X,fullLabel.AbsoluteSize.X, 
				function(size)
					fullLabel.Size = UDim2.new(0, size, 1, 0)
					return fullLabel.TextFits
				end)
			fullLabel.Size = UDim2.new(0,fullLabelSize+6,1,0)

			--Now setup the rollover effects, if they are currently off
			if mouseEnterConnection == nil then
				mouseEnterConnection = textLabel.MouseEnter:connect(
					function()
						fullLabel.ZIndex = textLabel.ZIndex + 1
						fullLabel.Visible = true
						--textLabel.Text = ""
					end)
			end
			if mouseLeaveConnection == nil then
				mouseLeaveConnection = textLabel.MouseLeave:connect(
					function()
						fullLabel.Visible = false
						--textLabel.Text = shortText
					end)
			end
		end
	end
	textLabel.AncestryChanged:connect(checkForResize)
	textLabel.Changed:connect(
		function(prop) 
			if prop == "AbsoluteSize" then 
				checkForResize() 	
			end 
		end)

	checkForResize()

	local function changeText(newText)
		text = newText
		fullLabel.Text = text
		checkForResize()
	end

	return textLabel, changeText
end

local function TransitionTutorialPages(fromPage, toPage, transitionFrame, currentPageValue)	
	if fromPage then
		fromPage.Visible = false
		if transitionFrame.Visible == false then
			transitionFrame.Size = fromPage.Size
			transitionFrame.Position = fromPage.Position
		end
	else
		if transitionFrame.Visible == false then
			transitionFrame.Size = UDim2.new(0.0,50,0.0,50)
			transitionFrame.Position = UDim2.new(0.5,-25,0.5,-25)
		end
	end
	transitionFrame.Visible = true
	currentPageValue.Value = nil

	local newsize, newPosition
	if toPage then
		--Make it visible so it resizes
		toPage.Visible = true

		newSize = toPage.Size
		newPosition = toPage.Position

		toPage.Visible = false
	else
		newSize = UDim2.new(0.0,50,0.0,50)
		newPosition = UDim2.new(0.5,-25,0.5,-25)
	end
	transitionFrame:TweenSizeAndPosition(newSize, newPosition, Enum.EasingDirection.InOut, Enum.EasingStyle.Quad, 0.3, true,
		function(state)
			if state == Enum.TweenStatus.Completed then
				transitionFrame.Visible = false
				if toPage then
					toPage.Visible = true
					currentPageValue.Value = toPage
				end
			end
		end)
end

RbxGuiLib.CreateTutorial = function(name, tutorialKey, createButtons)
	local frame = Instance.new("Frame")
	frame.Name = "Tutorial-" .. name
	frame.BackgroundTransparency = 1
	frame.Size = UDim2.new(0.6, 0, 0.6, 0)
	frame.Position = UDim2.new(0.2, 0, 0.2, 0)

	local transitionFrame = Instance.new("Frame")
	transitionFrame.Name = "TransitionFrame"
	transitionFrame.Style = Enum.FrameStyle.RobloxRound
	transitionFrame.Size = UDim2.new(0.6, 0, 0.6, 0)
	transitionFrame.Position = UDim2.new(0.2, 0, 0.2, 0)
	transitionFrame.Visible = false
	transitionFrame.Parent = frame

	local currentPageValue = Instance.new("ObjectValue")
	currentPageValue.Name = "CurrentTutorialPage"
	currentPageValue.Value = nil
	currentPageValue.Parent = frame

	local boolValue = Instance.new("BoolValue")
	boolValue.Name = "Buttons"
	boolValue.Value = createButtons
	boolValue.Parent = frame

	local pages = Instance.new("Frame")
	pages.Name = "Pages"
	pages.BackgroundTransparency = 1
	pages.Size = UDim2.new(1,0,1,0)
	pages.Parent = frame

	local function getVisiblePageAndHideOthers()
		local visiblePage = nil
		local children = pages:GetChildren()
		if children then
			for i,child in ipairs(children) do
				if child.Visible then
					if visiblePage then
						child.Visible = false
					else
						visiblePage = child
					end
				end
			end
		end
		return visiblePage
	end

	local showTutorial = function(alwaysShow)
		if alwaysShow or UserSettings().GameSettings:GetTutorialState(tutorialKey) == false then
			print("Showing tutorial-",tutorialKey)
			local currentTutorialPage = getVisiblePageAndHideOthers()

			local firstPage = pages:FindFirstChild("TutorialPage1")
			if firstPage then
				TransitionTutorialPages(currentTutorialPage, firstPage, transitionFrame, currentPageValue)	
			else
				error("Could not find TutorialPage1")
			end
		end
	end

	local dismissTutorial = function()
		local currentTutorialPage = getVisiblePageAndHideOthers()

		if currentTutorialPage then
			TransitionTutorialPages(currentTutorialPage, nil, transitionFrame, currentPageValue)
		end

		UserSettings().GameSettings:SetTutorialState(tutorialKey, true)
	end

	local gotoPage = function(pageNum)
		local page = pages:FindFirstChild("TutorialPage" .. pageNum)
		local currentTutorialPage = getVisiblePageAndHideOthers()
		TransitionTutorialPages(currentTutorialPage, page, transitionFrame, currentPageValue)
	end

	return frame, showTutorial, dismissTutorial, gotoPage
end 

local function CreateBasicTutorialPage(name, handleResize, skipTutorial)
	local frame = Instance.new("Frame")
	frame.Name = "TutorialPage"
	frame.Style = Enum.FrameStyle.RobloxRound
	frame.Size = UDim2.new(0.6, 0, 0.6, 0)
	frame.Position = UDim2.new(0.2, 0, 0.2, 0)
	frame.Visible = false
	
	local frameHeader = Instance.new("TextLabel")
	frameHeader.Name = "Header"
	frameHeader.Text = name
	frameHeader.BackgroundTransparency = 1
	frameHeader.FontSize = Enum.FontSize.Size24
	frameHeader.Font = Enum.Font.ArialBold
	frameHeader.TextColor3 = Color3.new(1,1,1)
	frameHeader.TextXAlignment = Enum.TextXAlignment.Center
	frameHeader.TextWrap = true
	frameHeader.Size = UDim2.new(1,-55, 0, 22)
	frameHeader.Position = UDim2.new(0,0,0,0)
	frameHeader.Parent = frame

	local skipButton = Instance.new("ImageButton")
	skipButton.Name = "SkipButton"
	skipButton.AutoButtonColor = false
	skipButton.BackgroundTransparency = 1
	skipButton.Image = "rbxasset://textures/ui/Skip.png"	
	skipButton.MouseButton1Click:connect(function()
		skipButton.Image = "rbxasset://textures/ui/Skip.png"	
		skipTutorial()
	end)
	skipButton.MouseEnter:connect(function()
		skipButton.Image = "rbxasset://textures/ui/SkipEnter.png"	
	end)
	skipButton.MouseLeave:connect(function()
		skipButton.Image = "rbxasset://textures/ui/Skip.png"	
	end)
	skipButton.Size = UDim2.new(0, 55, 0, 22)
	skipButton.Position = UDim2.new(1, -55, 0, 0)
	skipButton.Parent = frame

	local innerFrame = Instance.new("Frame")
	innerFrame.Name = "ContentFrame"
	innerFrame.BackgroundTransparency = 1
	innerFrame.Position = UDim2.new(0,0,0,22)
	innerFrame.Parent = frame

	local nextButton = Instance.new("TextButton")
	nextButton.Name = "NextButton"
	nextButton.Text = "Next"
	nextButton.TextColor3 = Color3.new(1,1,1)
	nextButton.Font = Enum.Font.Arial
	nextButton.FontSize = Enum.FontSize.Size18
	nextButton.Style = Enum.ButtonStyle.RobloxButtonDefault
	nextButton.Size = UDim2.new(0,80, 0, 32)
	nextButton.Position = UDim2.new(0.5, 5, 1, -32)
	nextButton.Active = false
	nextButton.Visible = false
	nextButton.Parent = frame

	local prevButton = Instance.new("TextButton")
	prevButton.Name = "PrevButton"
	prevButton.Text = "Previous"
	prevButton.TextColor3 = Color3.new(1,1,1)
	prevButton.Font = Enum.Font.Arial
	prevButton.FontSize = Enum.FontSize.Size18
	prevButton.Style = Enum.ButtonStyle.RobloxButton
	prevButton.Size = UDim2.new(0,80, 0, 32)
	prevButton.Position = UDim2.new(0.5, -85, 1, -32)
	prevButton.Active = false
	prevButton.Visible = false
	prevButton.Parent = frame

	innerFrame.Size = UDim2.new(1,0,1,-22-35)

	local parentConnection = nil

	local function basicHandleResize()
		if frame.Visible and frame.Parent then
			local maxSize = math.min(frame.Parent.AbsoluteSize.X, frame.Parent.AbsoluteSize.Y)
			handleResize(200,maxSize)
		end
	end

	frame.Changed:connect(
		function(prop)
			if prop == "Parent" then
				if parentConnection ~= nil then
					parentConnection:disconnect()
					parentConnection = nil
				end
				if frame.Parent and frame.Parent:IsA("GuiObject") then
					parentConnection = frame.Parent.Changed:connect(
						function(parentProp)
							if parentProp == "AbsoluteSize" then
								wait()
								basicHandleResize()
							end
						end)
					basicHandleResize()
				end
			end

			if prop == "Visible" then 
				basicHandleResize()
			end
		end)

	return frame, innerFrame
end

RbxGuiLib.CreateTextTutorialPage = function(name, text, skipTutorialFunc)
	local frame = nil
	local contentFrame = nil

	local textLabel = Instance.new("TextLabel")
	textLabel.BackgroundTransparency = 1
	textLabel.TextColor3 = Color3.new(1,1,1)
	textLabel.Text = text
	textLabel.TextWrap = true
	textLabel.TextXAlignment = Enum.TextXAlignment.Left
	textLabel.TextYAlignment = Enum.TextYAlignment.Center
	textLabel.Font = Enum.Font.Arial
	textLabel.FontSize = Enum.FontSize.Size14
	textLabel.Size = UDim2.new(1,0,1,0)

	local function handleResize(minSize, maxSize)
		size = binaryShrink(minSize, maxSize,
			function(size)
				frame.Size = UDim2.new(0, size, 0, size)
				return textLabel.TextFits
			end)
		frame.Size = UDim2.new(0, size, 0, size)
		frame.Position = UDim2.new(0.5, -size/2, 0.5, -size/2)
	end

	frame, contentFrame = CreateBasicTutorialPage(name, handleResize, skipTutorialFunc)
	textLabel.Parent = contentFrame

	return frame
end

RbxGuiLib.CreateImageTutorialPage = function(name, imageAsset, x, y, skipTutorialFunc)
	local frame = nil
	local contentFrame = nil

	local imageLabel = Instance.new("ImageLabel")
	imageLabel.BackgroundTransparency = 1
	imageLabel.Image = imageAsset
	imageLabel.Size = UDim2.new(0,x,0,y)
	imageLabel.Position = UDim2.new(0.5,-x/2,0.5,-y/2)

	local function handleResize(minSize, maxSize)
		size = binaryShrink(minSize, maxSize,
			function(size)
				return size >= x and size >= y
			end)
		if size >= x and size >= y then
			imageLabel.Size = UDim2.new(0,x, 0,y)
			imageLabel.Position = UDim2.new(0.5,-x/2, 0.5, -y/2)
		else
			if x > y then
				--X is limiter, so 
				imageLabel.Size = UDim2.new(1,0,y/x,0)
				imageLabel.Position = UDim2.new(0,0, 0.5 - (y/x)/2, 0)
			else
				--Y is limiter
				imageLabel.Size = UDim2.new(x/y,0,1, 0)
				imageLabel.Position = UDim2.new(0.5-(x/y)/2, 0, 0, 0)
			end
		end
		frame.Size = UDim2.new(0, size, 0, size)
		frame.Position = UDim2.new(0.5, -size/2, 0.5, -size/2)
	end

	frame, contentFrame = CreateBasicTutorialPage(name, handleResize, skipTutorialFunc)
	imageLabel.Parent = contentFrame

	return frame
end

RbxGuiLib.AddTutorialPage = function(tutorial, tutorialPage)
	local transitionFrame = tutorial.TransitionFrame
	local currentPageValue = tutorial.CurrentTutorialPage

	if not tutorial.Buttons.Value then
		tutorialPage.ContentFrame.Size = UDim2.new(1,0,1,-22)
		tutorialPage.NextButton.Parent = nil
		tutorialPage.PrevButton.Parent = nil
	end

	local children = tutorial.Pages:GetChildren()
	if children and #children > 0 then
		tutorialPage.Name = "TutorialPage" .. (#children+1)
		local previousPage = children[#children]
		if not previousPage:IsA("GuiObject") then
			error("All elements under Pages must be GuiObjects")
		end

		if tutorial.Buttons.Value then
			if previousPage.NextButton.Active then
				error("NextButton already Active on previousPage, please only add pages with RbxGui.AddTutorialPage function")
			end
			previousPage.NextButton.MouseButton1Click:connect(
				function()
					TransitionTutorialPages(previousPage, tutorialPage, transitionFrame, currentPageValue)
				end)
			previousPage.NextButton.Active = true
			previousPage.NextButton.Visible = true

			if tutorialPage.PrevButton.Active then
				error("PrevButton already Active on tutorialPage, please only add pages with RbxGui.AddTutorialPage function")
			end
			tutorialPage.PrevButton.MouseButton1Click:connect(
				function()
					TransitionTutorialPages(tutorialPage, previousPage, transitionFrame, currentPageValue)
				end)
			tutorialPage.PrevButton.Active = true
			tutorialPage.PrevButton.Visible = true
		end

		tutorialPage.Parent = tutorial.Pages
	else
		--First child
		tutorialPage.Name = "TutorialPage1"
		tutorialPage.Parent = tutorial.Pages
	end
end 

RbxGuiLib.Help = 
	function(funcNameOrFunc) 
		--input argument can be a string or a function.  Should return a description (of arguments and expected side effects)
		if funcNameOrFunc == "CreatePropertyDropDownMenu" or funcNameOrFunc == RbxGuiLib.CreatePropertyDropDownMenu then
			return "Function CreatePropertyDropDownMenu.  " ..
				   "Arguments: (instance, propertyName, enumType).  " .. 
				   "Side effect: returns a container with a drop-down-box that is linked to the 'property' field of 'instance' which is of type 'enumType'" 
		end 
		if funcNameOrFunc == "CreateDropDownMenu" or funcNameOrFunc == RbxGuiLib.CreateDropDownMenu then
			return "Function CreateDropDownMenu.  " .. 
			       "Arguments: (items, onItemSelected).  " .. 
				   "Side effect: Returns 2 results, a container to the gui object and a 'updateSelection' function for external updating.  The container is a drop-down-box created around a list of items" 
		end 
		if funcNameOrFunc == "CreateMessageDialog" or funcNameOrFunc == RbxGuiLib.CreateMessageDialog then
			return "Function CreateMessageDialog.  " .. 
			       "Arguments: (title, message, buttons). " .. 
			       "Side effect: Returns a gui object of a message box with 'title' and 'message' as passed in.  'buttons' input is an array of Tables contains a 'Text' and 'Function' field for the text/callback of each button"
		end		
		if funcNameOrFunc == "CreateStyledMessageDialog" or funcNameOrFunc == RbxGuiLib.CreateStyledMessageDialog then
			return "Function CreateStyledMessageDialog.  " .. 
			       "Arguments: (title, message, style, buttons). " .. 
			       "Side effect: Returns a gui object of a message box with 'title' and 'message' as passed in.  'buttons' input is an array of Tables contains a 'Text' and 'Function' field for the text/callback of each button, 'style' is a string, either Error, Notify or Confirm"
		end
		if funcNameOrFunc == "GetFontHeight" or funcNameOrFunc == RbxGuiLib.GetFontHeight then
			return "Function GetFontHeight.  " .. 
			       "Arguments: (font, fontSize). " .. 
			       "Side effect: returns the size in pixels of the given font + fontSize"
		end
		if funcNameOrFunc == "LayoutGuiObjects" or funcNameOrFunc == RbxGuiLib.LayoutGuiObjects then
		
		end
		if funcNameOrFunc == "CreateScrollingFrame" or funcNameOrFunc == RbxGuiLib.CreateScrollingFrame then
			return "Function CreateScrollingFrame.  " .. 
			   "Arguments: (orderList, style) " .. 
			   "Side effect: returns 4 objects, (scrollFrame, scrollUpButton, scrollDownButton, recalculateFunction).  'scrollFrame' can be filled with GuiObjects.  It will lay them out and allow scrollUpButton/scrollDownButton to interact with them.  Orderlist is optional (and specifies the order to layout the children.  Without orderlist, it uses the children order. style is also optional, and allows for a 'grid' styling if style is passed 'grid' as a string.  recalculateFunction can be called when a relayout is needed (when orderList changes)"
		end
		if funcNameOrFunc == "AutoTruncateTextObject" or funcNameOrFunc == RbxGuiLib.AutoTruncateTextObject then
			return "Function AutoTruncateTextObject.  " .. 
			   "Arguments: (textLabel) " .. 
			   "Side effect: returns 2 objects, (textLabel, changeText).  The 'textLabel' input is modified to automatically truncate text (with ellipsis), if it gets too small to fit.  'changeText' is a function that can be used to change the text, it takes 1 string as an argument"
		end
		if funcNameOrFunc == "CreateSlider" or funcNameOrFunc == RbxGuiLib.CreateSlider then
			return "Function CreateSlider.  " ..
				"Arguments: (steps, width, position) " ..
				"Side effect: returns 2 objects, (sliderGui, sliderPosition).  The 'steps' argument specifies how many different positions the slider can hold along the bar.  'width' specifies in pixels how wide the bar should be (modifiable afterwards if desired). 'position' argument should be a UDim2 for slider positioning. 'sliderPosition' is an IntValue whose current .Value specifies the specific step the slider is currently on."
		end
	end
-- RBXGUI END --

delay(0, function()

if game.CoreGui.Version < 3 then return end -- peace out if we aren't using the right client

-- A couple of necessary functions
local function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end
local function waitForProperty(instance, property)
	while not instance[property] do
		instance.Changed:wait()
	end
end

waitForChild(game,"Players")
waitForProperty(game.Players,"LocalPlayer")
local player = game.Players.LocalPlayer

local RbxGui,msg = RbxGuiLib
if not RbxGui then print("could not find RbxGui!") return end

--- Begin Locals
waitForChild(game,"Players")

-- don't do anything if we are in an empty game
if #game.Players:GetChildren() < 1 then
	game.Players.ChildAdded:wait()
end

local tilde = "~"
local backquote = "`"
game:GetService("GuiService"):AddKey(tilde) -- register our keys
game:GetService("GuiService"):AddKey(backquote)

local player = game.Players.LocalPlayer

local backpack = game:GetService("CoreGui").RobloxGui:FindFirstChild("Backpack")
local screen = game:GetService("CoreGui").RobloxGui
local closeButton = backpack.Tabs.CloseButton

local openCloseDebounce = false

local backpackItems = {}

local buttons = {}

local debounce = false

local guiTweenSpeed = 1

local backpackOldStateVisible = false
local browsingMenu = false

local mouseEnterCons = {}
local mouseClickCons = {}

local characterChildAddedCon = nil
local characterChildRemovedCon = nil
local backpackAddCon = nil
local humanoidDiedCon = nil
local backpackButtonClickCon = nil
local guiServiceKeyPressCon = nil

waitForChild(player,"Backpack")
local playerBackpack = player.Backpack

waitForChild(backpack,"Gear")
waitForChild(backpack.Gear,"GearPreview")
local gearPreview = backpack.Gear.GearPreview

waitForChild(backpack.Gear,"GearGridScrollingArea")
local scroller = backpack.Gear.GearGridScrollingArea

waitForChild(backpack.Parent,"CurrentLoadout")
local currentLoadout = backpack.Parent.CurrentLoadout

waitForChild(backpack.Parent,"ControlFrame")
waitForChild(backpack.Parent.ControlFrame,"BackpackButton")
local backpackButton = backpack.Parent.ControlFrame.BackpackButton

waitForChild(backpack.Gear,"GearGrid")
waitForChild(backpack.Gear.GearGrid,"GearButton")
local gearButton = backpack.Gear.GearGrid.GearButton
local grid = backpack.Gear.GearGrid

waitForChild(backpack.Gear.GearGrid,"SearchFrame")
waitForChild(backpack.Gear.GearGrid.SearchFrame,"SearchBoxFrame")
waitForChild(backpack.Gear.GearGrid.SearchFrame.SearchBoxFrame,"SearchBox")
local searchBox = backpack.Gear.GearGrid.SearchFrame.SearchBoxFrame.SearchBox

waitForChild(backpack.Gear.GearGrid.SearchFrame,"SearchButton")
local searchButton = backpack.Gear.GearGrid.SearchFrame.SearchButton

waitForChild(backpack.Gear.GearGrid,"ResetFrame")
local resetFrame = backpack.Gear.GearGrid.ResetFrame

waitForChild(backpack.Gear.GearGrid.ResetFrame,"ResetButtonBorder")
local resetButton = backpack.Gear.GearGrid.ResetFrame.ResetButtonBorder

waitForChild(backpack,"SwapSlot")
local swapSlot = backpack.SwapSlot


-- creating scroll bar early as to make sure items get placed correctly
local scrollFrame, scrollUp, scrollDown, recalculateScroll = RbxGui.CreateScrollingFrame(nil,"grid")

scrollFrame.Position = UDim2.new(0,0,0,30)
scrollFrame.Size = UDim2.new(1,0,1,-30)
scrollFrame.Parent = backpack.Gear.GearGrid

local scrollBar = Instance.new("Frame")
scrollBar.Name = "ScrollBar"
scrollBar.BackgroundTransparency = 0.9
scrollBar.BackgroundColor3 = Color3.new(1,1,1)
scrollBar.BorderSizePixel = 0
scrollBar.Size = UDim2.new(0, 17, 1, -36)
scrollBar.Position = UDim2.new(0,0,0,18)
scrollBar.Parent = scroller

scrollDown.Position = UDim2.new(0,0,1,-17)

scrollUp.Parent = scroller
scrollDown.Parent = scroller

local scrollFrameLoadout, scrollUpLoadout, scrollDownLoadout, recalculateScrollLoadout = RbxGui.CreateScrollingFrame()

scrollFrameLoadout.Position = UDim2.new(0,0,0,0)
scrollFrameLoadout.Size = UDim2.new(1,0,1,0)
scrollFrameLoadout.Parent = backpack.Gear.GearLoadouts.LoadoutsList

local LoadoutButton = Instance.new("TextButton")
LoadoutButton.RobloxLocked = true
LoadoutButton.Name = "LoadoutButton"
LoadoutButton.Font = Enum.Font.ArialBold
LoadoutButton.FontSize = Enum.FontSize.Size14
LoadoutButton.Position = UDim2.new(0,0,0,0)
LoadoutButton.Size = UDim2.new(1,0,0,32)
LoadoutButton.Style = Enum.ButtonStyle.RobloxButton
LoadoutButton.Text = "Loadout #1"
LoadoutButton.TextColor3 = Color3.new(1,1,1)
LoadoutButton.Parent = scrollFrameLoadout

local LoadoutButtonTwo = LoadoutButton:clone()
LoadoutButtonTwo.Text = "Loadout #2"
LoadoutButtonTwo.Parent = scrollFrameLoadout

local LoadoutButtonThree = LoadoutButton:clone()
LoadoutButtonThree.Text = "Loadout #3"
LoadoutButtonThree.Parent = scrollFrameLoadout

local LoadoutButtonFour = LoadoutButton:clone()
LoadoutButtonFour.Text = "Loadout #4"
LoadoutButtonFour.Parent = scrollFrameLoadout

local scrollBarLoadout = Instance.new("Frame")
scrollBarLoadout.Name = "ScrollBarLoadout"
scrollBarLoadout.BackgroundTransparency = 0.9
scrollBarLoadout.BackgroundColor3 = Color3.new(1,1,1)
scrollBarLoadout.BorderSizePixel = 0
scrollBarLoadout.Size = UDim2.new(0, 17, 1, -36)
scrollBarLoadout.Position = UDim2.new(0,0,0,18)
scrollBarLoadout.Parent = backpack.Gear.GearLoadouts.GearLoadoutsScrollingArea

scrollDownLoadout.Position = UDim2.new(0,0,1,-17)

scrollUpLoadout.Parent = backpack.Gear.GearLoadouts.GearLoadoutsScrollingArea
scrollDownLoadout.Parent = backpack.Gear.GearLoadouts.GearLoadoutsScrollingArea


-- Begin Functions
function removeFromMap(map,object)
	for i = 1, #map do
		if map[i] == object then
			table.remove(map,i)
			break
		end
	end
end

function robloxLock(instance)
  instance.RobloxLocked = true
  children = instance:GetChildren()
  if children then
	 for i, child in ipairs(children) do
		robloxLock(child)
	 end
  end
end

function resize()
	local size = 0
	if gearPreview.AbsoluteSize.Y > gearPreview.AbsoluteSize.X then
		size = gearPreview.AbsoluteSize.X * 0.75
	else
		size = gearPreview.AbsoluteSize.Y * 0.75
	end

	gearPreview.GearImage.Size = UDim2.new(0,size,0,size)
	gearPreview.GearImage.Position = UDim2.new(0,gearPreview.AbsoluteSize.X/2 - size/2,0.75,-size)
	
	resizeGrid()
end

function addToGrid(child)
	if not child:IsA("Tool") then
		if not child:IsA("HopperBin") then 
			return
		end
	end
	if child:FindFirstChild("RobloxBuildTool") then return end
	
	for i,v in pairs(backpackItems) do  -- check to see if we already have this gear registered
		if v == child then return end
	end

	table.insert(backpackItems,child)
	
	local changeCon = child.Changed:connect(function(prop)
		if prop == "Name" then
			if buttons[child] then
				if buttons[child].Image == "" then
					buttons[child].GearText.Text = child.Name
				end
			end
		end
	end)
	local ancestryCon = nil
	ancestryCon = child.AncestryChanged:connect(function(theChild,theParent)
		local thisObject = nil
		for k,v in pairs(backpackItems) do
			if v == child then
				thisObject = v
				break
			end
		end
		
		waitForProperty(player,"Character")
		waitForChild(player,"Backpack")
		if (child.Parent ~= player.Backpack and child.Parent ~= player.Character) then
			if ancestryCon then ancestryCon:disconnect() end
			if changeCon then changeCon:disconnect() end
			
			for k,v in pairs(backpackItems) do
				if v == thisObject then
					if mouseEnterCons[buttons[v]] then mouseEnterCons[buttons[v]]:disconnect() end
					if mouseClickCons[buttons[v]] then mouseClickCons[buttons[v]]:disconnect() end
					buttons[v].Parent = nil
					buttons[v] = nil
					break
				end
			end

			removeFromMap(backpackItems,thisObject)
			
			resizeGrid()
		else
			resizeGrid()
		end
		updateGridActive()
	end)
	resizeGrid()
end

function buttonClick(button)
	if button:FindFirstChild("UnequipContextMenu") and not button.Active then
		button.UnequipContextMenu.Visible = true
		browsingMenu = true
	end
end

function previewGear(button)
	if not browsingMenu then
		gearPreview.GearImage.Image = button.Image
		gearPreview.GearStats.GearName.Text = button.GearReference.Value.Name
	end
end

function checkForSwap(button,x,y)
	local loadoutChildren = currentLoadout:GetChildren()
	for i = 1, #loadoutChildren do
		if loadoutChildren[i]:IsA("Frame") and string.find(loadoutChildren[i].Name,"Slot") then
			if x >= loadoutChildren[i].AbsolutePosition.x and x <= (loadoutChildren[i].AbsolutePosition.x + loadoutChildren[i].AbsoluteSize.x) then
				if y >= loadoutChildren[i].AbsolutePosition.y and y <= (loadoutChildren[i].AbsolutePosition.y + loadoutChildren[i].AbsoluteSize.y) then
					local slot = tonumber(string.sub(loadoutChildren[i].Name,5))
					swapGearSlot(slot,button)
					return true
				end
			end
		end
	end
	return false
end

function resizeGrid()
	for k,v in pairs(backpackItems) do
		if not v:FindFirstChild("RobloxBuildTool") then
			if not buttons[v] then
				local buttonClone = gearButton:clone()
				buttonClone.Parent = grid.ScrollingFrame
				buttonClone.Visible = true
				buttonClone.Image = v.TextureId
				if buttonClone.Image == "" then
					buttonClone.GearText.Text = v.Name
				end
				--print("v =",v)
				buttonClone.GearReference.Value = v
				buttonClone.Draggable = true 
				buttons[v] = buttonClone
				
				local unequipMenu = getGearContextMenu()
				
				unequipMenu.Visible = false
				unequipMenu.Parent = buttonClone
				
				local beginPos = nil
				buttonClone.DragBegin:connect(function(value)
					buttonClone.ZIndex = 9
					beginPos = value
				end)
				buttonClone.DragStopped:connect(function(x,y)
					if beginPos ~= buttonClone.Position then
						buttonClone.ZIndex = 1
						if not checkForSwap(buttonClone,x,y) then
							buttonClone:TweenPosition(beginPos,Enum.EasingDirection.Out, Enum.EasingStyle.Quad, 0.5, true)
							buttonClone.Draggable = false
							delay(0.5,function()
								buttonClone.Draggable = true
							end)
						else
							buttonClone.Position = beginPos
						end
					end	
				end)
				
				mouseEnterCons[buttonClone] = buttonClone.MouseEnter:connect(function() previewGear(buttonClone) end)
				mouseClickCons[buttonClone] = buttonClone.MouseButton1Click:connect(function() buttonClick(buttonClone) end)
			end
		end
	end
	recalculateScroll()
end

function showPartialGrid(subset)

	resetFrame.Visible = true

	for k,v in pairs(buttons) do
		v.Parent = nil
	end
	for k,v in pairs(subset) do
		v.Parent =  grid.ScrollingFrame
	end
	recalculateScroll()
end

function showEntireGrid()
	resetFrame.Visible = false
	
	for k,v in pairs(buttons) do
		v.Parent = grid.ScrollingFrame
	end
	recalculateScroll()
end

function inLoadout(gear)
	local children = currentLoadout:GetChildren()
	for i = 1, #children do
		if children[i]:IsA("Frame") then
			local button = children[i]:GetChildren()
			if #button > 0 then
				if button[1].GearReference.Value and button[1].GearReference.Value == gear then
					return true
				end
			end
		end
	end
	return false
end	

function updateGridActive()
	for k,v in pairs(backpackItems) do
		if buttons[v] then
			local gear = nil
			local gearRef = buttons[v]:FindFirstChild("GearReference")
			
			if gearRef then gear = gearRef.Value end
			
			if not gear then
				buttons[v].Active = false
			elseif inLoadout(gear) then
				buttons[v].Active = false
			else
				buttons[v].Active = true
			end
		end
	end
end

function centerGear(loadoutChildren)
	local gearButtons = {}
	local lastSlotAdd = nil
	for i = 1, #loadoutChildren do
		if loadoutChildren[i]:IsA("Frame") and #loadoutChildren[i]:GetChildren() > 0 then
			if loadoutChildren[i].Name == "Slot0" then 
				lastSlotAdd = loadoutChildren[i]
			else
				table.insert(gearButtons, loadoutChildren[i])
			end
		end
	end
	if lastSlotAdd then table.insert(gearButtons,lastSlotAdd) end
	
	local startPos = ( 1 - (#gearButtons * 0.1) ) / 2
	for i = 1, #gearButtons do	
		gearButtons[i]:TweenPosition(UDim2.new(startPos + ((i - 1) * 0.1),0,0,0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, 0.25, true)
	end
end

function spreadOutGear(loadoutChildren)
	for i = 1, #loadoutChildren do
		if loadoutChildren[i]:IsA("Frame") then
			local slot = tonumber(string.sub(loadoutChildren[i].Name,5))
			if slot == 0 then slot = 10 end
			loadoutChildren[i]:TweenPosition(UDim2.new((slot - 1)/10,0,0,0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, 0.25, true)
		end
	end
end

function openCloseBackpack()
	if openCloseDebounce then return end
	openCloseDebounce = true
	
	local visible = not backpack.Visible
	if visible then
		updateGridActive()
		local centerDialogSupported, msg = pcall(function() game.GuiService:AddCenterDialog(backpack, Enum.CenterDialogType.PlayerInitiatedDialog, 
			function()
				backpack.Visible = true
				loadoutChildren = currentLoadout:GetChildren()
				for i = 1, #loadoutChildren do
					if loadoutChildren[i]:IsA("Frame") then
						loadoutChildren[i].BackgroundTransparency = 0.5
					end
				end 
				spreadOutGear(loadoutChildren)
			end)
		end)
		backpackButton.Selected = true
		backpack:TweenSizeAndPosition(UDim2.new(0.55, 0, 0.6, 0),UDim2.new(0.225, 0, 0.2, 0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, guiTweenSpeed/2, true)
		delay(guiTweenSpeed/2 + 0.01,
			function()
				local children = backpack:GetChildren()
				for i = 1, #children do
					if children[i]:IsA("Frame") then
						children[i].Visible = true
					end
				end
				resizeGrid()
				resize()
				openCloseDebounce = false
			end)
	else
		backpackButton.Selected = false
		local children = backpack:GetChildren()
		for i = 1, #children do
			if children[i]:IsA("Frame") then
				children[i].Visible = false
			end
		end
		loadoutChildren = currentLoadout:GetChildren()
		for i = 1, #loadoutChildren do
			if loadoutChildren[i]:IsA("Frame") then
				loadoutChildren[i].BackgroundTransparency = 1
			end
		end
		centerGear(loadoutChildren)
	
		backpack:TweenSizeAndPosition(UDim2.new(0,0,0,0),UDim2.new(0.5,0,0.5,0), Enum.EasingDirection.Out, Enum.EasingStyle.Quad, guiTweenSpeed/2, true)
		delay(guiTweenSpeed/2 + 0.01,
			function()
				backpack.Visible = visible
				resizeGrid()
				resize()
				pcall(function() game.GuiService:RemoveCenterDialog(backpack) end)
				openCloseDebounce = false
			end)
	end
end

function loadoutCheck(child, selectState)
	if not child:IsA("ImageButton") then return end
	for k,v in pairs(backpackItems) do
		if buttons[v] then
			if child:FindFirstChild("GearReference") then
				if buttons[v].GearReference.Value == child.GearReference.Value then
					buttons[v].Active = selectState
					break
				end
			end
		end
	end
end

function clearPreview()
	gearPreview.GearImage.Image = ""
	gearPreview.GearStats.GearName.Text = ""
end

function removeAllEquippedGear(physGear)
	local stuff = player.Character:GetChildren()
	for i = 1, #stuff do
		if ( stuff[i]:IsA("Tool") or stuff[i]:IsA("HopperBin") ) and stuff[i] ~= physGear then
			stuff[i].Parent = playerBackpack
		end
	end
end

function equipGear(physGear)
	removeAllEquippedGear(physGear)
	physGear.Parent = player.Character
	updateGridActive()
end

function unequipGear(physGear)
	physGear.Parent = playerBackpack
	updateGridActive()
end

function highlight(button)
	button.TextColor3 = Color3.new(0,0,0)
	button.BackgroundColor3 = Color3.new(0.8,0.8,0.8)
end
function clearHighlight(button)
	button.TextColor3 = Color3.new(1,1,1)
	button.BackgroundColor3 = Color3.new(0,0,0)
end

function swapGearSlot(slot,gearButton)
	if not swapSlot.Value then -- signal loadout to swap a gear out
		swapSlot.Slot.Value = slot
		swapSlot.GearButton.Value = gearButton
		swapSlot.Value = true
		updateGridActive()
	end
end


local UnequipGearMenuClick = function(element, menu)
	if type(element.Action) ~= "number" then return end
	local num = element.Action
	if num == 1 then -- remove from loadout
		unequipGear(menu.Parent.GearReference.Value)
		local inventoryButton = menu.Parent
		local gearToUnequip = inventoryButton.GearReference.Value
		local loadoutChildren = currentLoadout:GetChildren()
		local slot = -1
		for i = 1, #loadoutChildren do
			if loadoutChildren[i]:IsA("Frame") then
				local button = loadoutChildren[i]:GetChildren()
				if button[1] and button[1].GearReference.Value == gearToUnequip then
					slot = button[1].SlotNumber.Text
					break
				end
			end
		end
		swapGearSlot(slot,nil)
	end
end

-- these next two functions are used to stop any use of backpack while the player is dead (can cause issues)
function activateBackpack()
	backpack.Visible = backpackOldStateVisible
	
	backpackButtonClickCon = backpackButton.MouseButton1Click:connect(function() openCloseBackpack() end)
	guiServiceKeyPressCon = game:GetService("GuiService").KeyPressed:connect(function(key)
		if key == tilde or key == backquote then
			openCloseBackpack()
		end
	end)
end
function deactivateBackpack()
	if backpackButtonClickCon then backpackButtonClickCon:disconnect() end
	if guiServiceKeyPressCon then guiServiceKeyPressCon:disconnect() end

	backpackOldStateVisible = backpack.Visible
	backpack.Visible = false
end

function setupCharacterConnections()

	if backpackAddCon then backpackAddCon:disconnect() end
	backpackAddCon = game.Players.LocalPlayer.Backpack.ChildAdded:connect(function(child) addToGrid(child) end)
	
	-- make sure we get all the children
	local backpackChildren = game.Players.LocalPlayer.Backpack:GetChildren()
	for i = 1, #backpackChildren do
		addToGrid(backpackChildren[i])
	end

	if characterChildAddedCon then characterChildAddedCon:disconnect() end
	characterChildAddedCon = 
		game.Players.LocalPlayer.Character.ChildAdded:connect(function(child)
			addToGrid(child)
			updateGridActive()
		end)
		
	if characterChildRemovedCon then characterChildRemovedCon:disconnect() end
	characterChildRemovedCon = 
		game.Players.LocalPlayer.Character.ChildRemoved:connect(function(child)
			updateGridActive()
		end)
		
			
	if humanoidDiedCon then humanoidDiedCon:disconnect() end
	local localPlayer = game.Players.LocalPlayer
	waitForProperty(localPlayer,"Character")
	waitForChild(localPlayer.Character,"Humanoid")
	humanoidDiedCon = game.Players.LocalPlayer.Character.Humanoid.Died:connect(function() deactivateBackpack() end)
	
	activateBackpack()
end

function removeCharacterConnections()
	if characterChildAddedCon then characterChildAddedCon:disconnect() end
	if characterChildRemovedCon then characterChildRemovedCon:disconnect() end
	if backpackAddCon then backpackAddCon:disconnect() end
end

function trim(s)
  return (s:gsub("^%s*(.-)%s*$", "%1"))
end

function splitByWhiteSpace(text)
	if type(text) ~= "string" then return nil end
	
	local terms = {}
	for token in string.gmatch(text, "[^%s]+") do
	   if string.len(token) > 2 then
			table.insert(terms,token)
	   end
	end
	return terms
end

function filterGear(searchTerm)
	string.lower(searchTerm)
	searchTerm = trim(searchTerm)
	if string.len(searchTerm) < 2 then return nil end
	local terms = splitByWhiteSpace(searchTerm)
	
	local filteredGear = {}
	for k,v in pairs(backpackItems) do
		if buttons[v] then
			local gearString = string.lower(buttons[v].GearReference.Value.Name)
			gearString = trim(gearString)
			for i = 1, #terms do
				if string.match(gearString,terms[i]) then
					table.insert(filteredGear,buttons[v])
					break
				end
			end
		end
	end
	
	return filteredGear
end


function showSearchGear()
	local searchText = searchBox.Text
	searchBox.Text = "Search..."
	local filteredButtons = filterGear(searchText)
	if filteredButtons and #filteredButtons > 0 then
		showPartialGrid(filteredButtons)
	else
		showEntireGrid()
	end
end

function nukeBackpack()
	while #buttons > 0 do
		table.remove(buttons)
	end
	buttons = {}
	while #backpackItems > 0 do
		table.remove(backpackItems)
	end
	backpackItems = {}
	local scrollingFrameChildren = grid.ScrollingFrame:GetChildren()
	for i = 1, #scrollingFrameChildren do
		scrollingFrameChildren[i]:remove()
	end
end

function getGearContextMenu()
	local gearContextMenu = Instance.new("Frame")
	gearContextMenu.Active = true
	gearContextMenu.Name = "UnequipContextMenu"
	gearContextMenu.Size = UDim2.new(0,115,0,70)
	gearContextMenu.Position = UDim2.new(0,-16,0,-16)
	gearContextMenu.BackgroundTransparency = 1
	gearContextMenu.Visible = false

	local gearContextMenuButton = Instance.new("TextButton")
	gearContextMenuButton.Name = "UnequipContextMenuButton"
	gearContextMenuButton.Text = ""
	gearContextMenuButton.Style = Enum.ButtonStyle.RobloxButtonDefault
	gearContextMenuButton.ZIndex = 4
	gearContextMenuButton.Size = UDim2.new(1, 0, 1, -20)
	gearContextMenuButton.Visible = true
	gearContextMenuButton.Parent = gearContextMenu
	
	local elementHeight = 12
	
	local contextMenuElements = {}		
	local contextMenuElementsName = {"Remove Hotkey"}

	for i = 1, #contextMenuElementsName do
		local element = {}
		element.Type = "Button"
		element.Text = contextMenuElementsName[i]
		element.Action = i
		element.DoIt = UnequipGearMenuClick
		table.insert(contextMenuElements,element)
	end

	for i, contextElement in ipairs(contextMenuElements) do
		local element = contextElement
		if element.Type == "Button" then
			local button = Instance.new("TextButton")
			button.Name = "UnequipContextButton" .. i
			button.BackgroundColor3 = Color3.new(0,0,0)
			button.BorderSizePixel = 0
			button.TextXAlignment = Enum.TextXAlignment.Left
			button.Text = " " .. contextElement.Text
			button.Font = Enum.Font.Arial
			button.FontSize = Enum.FontSize.Size14
			button.Size = UDim2.new(1, 8, 0, elementHeight)
			button.Position = UDim2.new(0,0,0,elementHeight * i)
			button.TextColor3 = Color3.new(1,1,1)
			button.ZIndex = 4
			button.Parent = gearContextMenuButton

			button.MouseButton1Click:connect(function()
				if button.Active and not gearContextMenu.Parent.Active then
					local success, result = pcall(function() element.DoIt(element, gearContextMenu) end)
					browsingMenu = false
					gearContextMenu.Visible = false
					clearHighlight(button)
					clearPreview()
				end
			end)
			
			button.MouseEnter:connect(function()
				if button.Active and gearContextMenu.Parent.Active then
					highlight(button)
				end
			end)
			button.MouseLeave:connect(function()
				if button.Active and gearContextMenu.Parent.Active then
					clearHighlight(button)
				end
			end)
			
			contextElement.Button = button
			contextElement.Element = button
		elseif element.Type == "Label" then
			local frame = Instance.new("Frame")
			frame.Name = "ContextLabel" .. i
			frame.BackgroundTransparency = 1
			frame.Size = UDim2.new(1, 8, 0, elementHeight)

			local label = Instance.new("TextLabel")	
			label.Name = "Text1"
			label.BackgroundTransparency = 1
			label.BackgroundColor3 = Color3.new(1,1,1)
			label.BorderSizePixel = 0
			label.TextXAlignment = Enum.TextXAlignment.Left
			label.Font = Enum.Font.ArialBold
			label.FontSize = Enum.FontSize.Size14
			label.Position = UDim2.new(0.0, 0, 0, 0)
			label.Size = UDim2.new(0.5, 0, 1, 0)
			label.TextColor3 = Color3.new(1,1,1)
			label.ZIndex = 4
			label.Parent = frame
			element.Label1 = label
		
			if element.GetText2 then
				label = Instance.new("TextLabel")	
				label.Name = "Text2"
				label.BackgroundTransparency = 1
				label.BackgroundColor3 = Color3.new(1,1,1)
				label.BorderSizePixel = 0
				label.TextXAlignment = Enum.TextXAlignment.Right
				label.Font = Enum.Font.Arial
				label.FontSize = Enum.FontSize.Size14
				label.Position = UDim2.new(0.5, 0, 0, 0)
				label.Size = UDim2.new(0.5, 0, 1, 0)
				label.TextColor3 = Color3.new(1,1,1)
				label.ZIndex = 4
				label.Parent = frame
				element.Label2 = label
			end
			frame.Parent = gearContextMenuButton
			element.Label = frame
			element.Element =  frame
		end
	end

	gearContextMenu.ZIndex = 4
	gearContextMenu.MouseLeave:connect(function()
		browsingMenu = false
		gearContextMenu.Visible = false
		clearPreview()
	end)
	robloxLock(gearContextMenu)
	
	return gearContextMenu
end

local backpackChildren = player.Backpack:GetChildren()
for i = 1, #backpackChildren do
	addToGrid(backpackChildren[i])
end

------------------------- Start Lifelong Connections -----------------------
screen.Changed:connect(function(prop)
	if prop == "AbsoluteSize" then
		if debounce then return end
		debounce = true
		wait()
		resize()
		resizeGrid()
		debounce = false
	end
end)

currentLoadout.ChildAdded:connect(function(child) loadoutCheck(child, false) end)
currentLoadout.ChildRemoved:connect(function(child) loadoutCheck(child, true) end)

currentLoadout.DescendantAdded:connect(function(descendant)
	if not backpack.Visible and ( descendant:IsA("ImageButton") or descendant:IsA("TextButton") ) then
		centerGear(currentLoadout:GetChildren())
	end
end)
currentLoadout.DescendantRemoving:connect(function(descendant)
	if not backpack.Visible and ( descendant:IsA("ImageButton") or descendant:IsA("TextButton") ) then
		wait()
		centerGear(currentLoadout:GetChildren())
	end
end)
	
grid.MouseEnter:connect(function() clearPreview() end)
grid.MouseLeave:connect(function() clearPreview() end)

player.CharacterRemoving:connect(function()
	removeCharacterConnections()
	nukeBackpack()
end)
player.CharacterAdded:connect(function() setupCharacterConnections() end)

player.ChildAdded:connect(function(child)
	if child:IsA("Backpack") then
		playerBackpack = child
		if backpackAddCon then backpackAddCon:disconnect() end
		backpackAddCon = game.Players.LocalPlayer.Backpack.ChildAdded:connect(function(child) addToGrid(child) end)
	end
end)

swapSlot.Changed:connect(function()
	if not swapSlot.Value then
		updateGridActive()
	end
end)

searchBox.FocusLost:connect(function(enterPressed)
	if enterPressed then
		showSearchGear()
	end
end)

local loadoutChildren = currentLoadout:GetChildren()
for i = 1, #loadoutChildren do
	if loadoutChildren[i]:IsA("Frame") and string.find(loadoutChildren[i].Name,"Slot") then
		loadoutChildren[i].ChildRemoved:connect(function()
			updateGridActive()
		end)
		loadoutChildren[i].ChildAdded:connect(function()
			updateGridActive()
		end)
	end
end

closeButton.MouseButton1Click:connect(function() openCloseBackpack() end)

searchButton.MouseButton1Click:connect(function() showSearchGear() end)
resetButton.MouseButton1Click:connect(function() showEntireGrid() end)
------------------------- End Lifelong Connections -----------------------

resize()
resizeGrid()

-- make sure any items in the loadout are accounted for in inventory
local loadoutChildren = currentLoadout:GetChildren()
for i = 1, #loadoutChildren do
	loadoutCheck(loadoutChildren[i], false)
end
if not backpack.Visible then centerGear(currentLoadout:GetChildren()) end

-- make sure that inventory is listening to gear reparenting
if characterChildAddedCon == nil and game.Players.LocalPlayer["Character"] then
	setupCharacterConnections()
end
if not backpackAddCon then
	backpackAddCon = game.Players.LocalPlayer.Backpack.ChildAdded:connect(function(child) addToGrid(child) end)
end

-- flip it on if we are good
if game.CoreGui.Version >= 3 then
	backpackButton.Visible = true
end

recalculateScrollLoadout()

end)

delay(0, function()

if game.CoreGui.Version < 3 then return end -- peace out if we aren't using the right client

-- A couple of necessary functions
local function waitForChild(instance, name)
	while not instance:FindFirstChild(name) do
		instance.ChildAdded:wait()
	end
end
local function waitForProperty(instance, property)
	while not instance[property] do
		instance.Changed:wait()
	end
end





--- Begin Locals
waitForChild(game,"Players")
waitForProperty(game.Players,"LocalPlayer")
local player = game.Players.LocalPlayer

waitForChild(game, "LocalBackpack")
game.LocalBackpack:SetOldSchoolBackpack(false)

local currentLoadout = game:GetService("CoreGui").RobloxGui:FindFirstChild("CurrentLoadout")
local maxNumLoadoutItems = 10

local guiBackpack = currentLoadout.Parent.Backpack

local characterChildAddedCon = nil
local keyPressCon = nil
local backpackChildCon = nil

local debounce = currentLoadout.Debounce

local waitingOnEnlarge = nil

local enlargeFactor = 1.18
local buttonSizeEnlarge = UDim2.new(1 * enlargeFactor,0,1 * enlargeFactor,0)
local buttonSizeNormal = UDim2.new(1,0,1,0)
local enlargeOverride = true

local guiTweenSpeed = 0.5

for i = 0, 9 do
	game:GetService("GuiService"):AddKey(tostring(i)) -- register our keys
end

local gearSlots = {}
for i = 1, maxNumLoadoutItems do
	gearSlots[i] = "empty"
end

local inventory = {}
--- End Locals






-- Begin Functions
local function kill(prop,con,gear)
	if con then con:disconnect() end
	if prop == true and gear then
		reorganizeLoadout(gear,false)
	end
end

function removeGear(gear)
	local emptySlot = nil
	for i = 1, #gearSlots do
		if gearSlots[i] == gear and gear.Parent ~= nil then
			emptySlot = i
			break
		end
	end
	if emptySlot then
		if gearSlots[emptySlot].GearReference.Value then
			if gearSlots[emptySlot].GearReference.Value.Parent == game.Players.LocalPlayer.Character then -- if we currently have this equipped, unequip it
				gearSlots[emptySlot].GearReference.Value.Parent = game.Players.LocalPlayer.Backpack
			end
			
			if gearSlots[emptySlot].GearReference.Value:IsA("HopperBin") and gearSlots[emptySlot].GearReference.Value.Active then -- this is an active hopperbin
				gearSlots[emptySlot].GearReference.Value:Disable()
				gearSlots[emptySlot].GearReference.Value.Active = false
			end
		end
		
		gearSlots[emptySlot] = "empty"
		
		local centerizeX = gear.Size.X.Scale/2
		local centerizeY = gear.Size.Y.Scale/2
		gear:TweenSizeAndPosition(UDim2.new(0,0,0,0),
			UDim2.new(gear.Position.X.Scale + centerizeX,gear.Position.X.Offset,gear.Position.Y.Scale + centerizeY,gear.Position.Y.Offset),
			Enum.EasingDirection.Out, Enum.EasingStyle.Quad,guiTweenSpeed/4,true)
		delay(guiTweenSpeed/2,
			function()
				gear:remove()
			end)
	end
end

function insertGear(gear, addToSlot)
	local pos = nil
	if not addToSlot then
		for i = 1, #gearSlots do
			if gearSlots[i] == "empty" then
				pos = i
				break
			end
		end
		
		if pos == 1 and gearSlots[1] ~= "empty" then gear:remove() return end -- we are currently full, can't add in
	else
		pos = addToSlot
		-- push all gear down one slot
		local start = 1
		for i = 1, #gearSlots do
			if gearSlots[i] == "empty" then
				start = i
				break
			end
		end
		for i = start, pos + 1, -1 do
			gearSlots[i] = gearSlots[i - 1]
			if i == 10 then
				gearSlots[i].SlotNumber.Text = "0"
				gearSlots[i].SlotNumberDownShadow.Text = "0"
				gearSlots[i].SlotNumberUpShadow.Text = "0"
			else
				gearSlots[i].SlotNumber.Text = i
				gearSlots[i].SlotNumberDownShadow.Text = i
				gearSlots[i].SlotNumberUpShadow.Text = i
			end
		end
	end

	gearSlots[pos] = gear
	if pos ~= maxNumLoadoutItems then
		if(type(tostring(pos)) == "string") then
			local posString = tostring(pos) 
			gear.SlotNumber.Text = posString
			gear.SlotNumberDownShadow.Text = posString
			gear.SlotNumberUpShadow.Text = posString
		end
	else -- tenth gear doesn't follow mathematical pattern :(
		gear.SlotNumber.Text = "0"
		gear.SlotNumberDownShadow.Text = "0"
		gear.SlotNumberUpShadow.Text = "0"
	end
	gear.Visible = true

	local con = nil
	con = gear.Kill.Changed:connect(function(prop) kill(prop,con,gear) end)
end


function reorganizeLoadout(gear, inserting, equipped, addToSlot)
	if inserting then -- add in gear
		insertGear(gear, addToSlot)
	else
		removeGear(gear)
	end
	if gear ~= "empty" then gear.ZIndex = 1 end
end

function checkToolAncestry(child,parent)
	if child:FindFirstChild("RobloxBuildTool") then return end -- don't show roblox build tools
	if child:IsA("Tool") or child:IsA("HopperBin") then
		for i = 1, #gearSlots do
			if gearSlots[i] ~= "empty" and gearSlots[i].GearReference.Value == child then
				if parent == nil then 
					gearSlots[i].Kill.Value = true
					return false
				elseif child.Parent == player.Character then
					gearSlots[i].Selected = true
					return true
				elseif child.Parent == player.Backpack then
					if child:IsA("Tool") then gearSlots[i].Selected = false end
					return true
				else
					gearSlots[i].Kill.Value = true
					return false
				end
				return true
			end
		end
	end
end

function removeAllEquippedGear(physGear)
	local stuff = player.Character:GetChildren()
	for i = 1, #stuff do
		if ( stuff[i]:IsA("Tool") or stuff[i]:IsA("HopperBin") ) and stuff[i] ~= physGear then
			if stuff[i]:IsA("Tool") then stuff[i].Parent = player.Backpack end
			if stuff[i]:IsA("HopperBin") then
				stuff[i]:Disable()
			end
		end
	end
end

function hopperBinSwitcher(numKey, physGear)
	if not physGear then return end
	
	physGear:ToggleSelect()
	
	if gearSlots[numKey] == "empty" then return end
	
	if not physGear.Active then
		gearSlots[numKey].Selected = false
		normalizeButton(gearSlots[numKey])
	else
		gearSlots[numKey].Selected = true
		enlargeButton(gearSlots[numKey])
	end
end

function toolSwitcher(numKey)

	if not gearSlots[numKey] then return end
	local physGear = gearSlots[numKey].GearReference.Value
	if physGear == nil then return end

	removeAllEquippedGear(physGear) -- we don't remove this gear, as then we get a double switcheroo

	local key = numKey
	if numKey == 0 then key = 10 end
		
	for i = 1, #gearSlots do
		if gearSlots[i] and gearSlots[i] ~= "empty" and i ~= key then
			normalizeButton(gearSlots[i])
			gearSlots[i].Selected = false
			if gearSlots[i].GearReference.Value:IsA("HopperBin") and gearSlots[i].GearReference.Value.Active then
				gearSlots[i].GearReference.Value:ToggleSelect()
			end
		end
	end
	
	if physGear:IsA("HopperBin") then
		hopperBinSwitcher(numKey,physGear)
	else
		if physGear.Parent == player.Character then
			physGear.Parent = player.Backpack
			gearSlots[numKey].Selected = false
			
			normalizeButton(gearSlots[numKey])
		else
			physGear.Parent = player.Character
			gearSlots[numKey].Selected = true
			
			enlargeButton(gearSlots[numKey])
		end
	end
end


function activateGear(num)
	local numKey = nil
	if num == "0" then
		numKey = 10 -- why do lua indexes have to start at 1? :(
	else
		numKey = tonumber(num)
	end

	if(numKey == nil) then return end

	if gearSlots[numKey] ~= "empty" then
		toolSwitcher(numKey)
	end
end


enlargeButton = function(button)
	if button.Size.Y.Scale > 1 then return end
	if not button.Parent then return end
	if not button.Selected then return end

	for i = 1, #gearSlots do
		if gearSlots[i] == "empty" then break end
		if gearSlots[i] ~= button then
			normalizeButton(gearSlots[i])
		end
	end
	
	if not enlargeOverride then
		waitingOnEnlarge = button
		return
	end

	if button:IsA("ImageButton") or button:IsA("TextButton") then
		button.ZIndex = 2
		local centerizeX = -(buttonSizeEnlarge.X.Scale - button.Size.X.Scale)/2
		local centerizeY = -(buttonSizeEnlarge.Y.Scale - button.Size.Y.Scale)/2
		button:TweenSizeAndPosition(buttonSizeEnlarge,
			UDim2.new(button.Position.X.Scale + centerizeX,button.Position.X.Offset,button.Position.Y.Scale + centerizeY,button.Position.Y.Offset),
			Enum.EasingDirection.Out, Enum.EasingStyle.Quad,guiTweenSpeed/5,enlargeOverride)
	end
end

normalizeAllButtons = function()
	for i = 1, #gearSlots do
		if gearSlots[i] == "empty" then break end
		if gearSlots[i] ~= button then
			normalizeButton(gearSlots[i],0.1)
		end
	end
end


normalizeButton = function(button, speed)
	if not button then return end
	if button.Size.Y.Scale <= 1 then return end
	if button.Selected then return end
	if not button.Parent then return end
	
	local moveSpeed = speed
	if moveSpeed == nil or type(moveSpeed) ~= "number" then moveSpeed = guiTweenSpeed/5 end

	if button:IsA("ImageButton") or button:IsA("TextButton") then
		button.ZIndex = 1
		local inverseEnlarge = 1/enlargeFactor
		local centerizeX = -(buttonSizeNormal.X.Scale - button.Size.X.Scale)/2
		local centerizeY = -(buttonSizeNormal.Y.Scale - button.Size.Y.Scale)/2
		button:TweenSizeAndPosition(buttonSizeNormal,
			UDim2.new(button.Position.X.Scale + centerizeX,button.Position.X.Offset,button.Position.Y.Scale + centerizeY,button.Position.Y.Offset),
			Enum.EasingDirection.Out, Enum.EasingStyle.Quad,moveSpeed,enlargeOverride)
	end
end

waitForDebounce = function()
	if debounce.Value then
		debounce.Changed:wait()
	end
end

function pointInRectangle(point,rectTopLeft,rectSize)
	if point.x > rectTopLeft.x and point.x < (rectTopLeft.x + rectSize.x) then
		if point.y > rectTopLeft.y and point.y < (rectTopLeft.y + rectSize.y) then
			return true
		end
	end
	return false
end

function swapGear(gearClone,toFrame)
	local toFrameChildren = toFrame:GetChildren()
	if #toFrameChildren == 1 then
		if toFrameChildren[1]:FindFirstChild("SlotNumber") then
		
			local toSlot = tonumber(toFrameChildren[1].SlotNumber.Text)
			local gearCloneSlot = tonumber(gearClone.SlotNumber.Text)
			if toSlot == 0 then toSlot = 10 end
			if gearCloneSlot == 0 then gearCloneSlot = 10 end
			
			gearSlots[toSlot] = gearClone
			gearSlots[gearCloneSlot] = toFrameChildren[1]
			
			toFrameChildren[1].SlotNumber.Text = gearClone.SlotNumber.Text
			toFrameChildren[1].SlotNumberDownShadow.Text = gearClone.SlotNumber.Text
			toFrameChildren[1].SlotNumberUpShadow.Text = gearClone.SlotNumber.Text
			
			local subString = string.sub(toFrame.Name,5)
			gearClone.SlotNumber.Text = subString
			gearClone.SlotNumberDownShadow.Text = subString
			gearClone.SlotNumberUpShadow.Text = subString
			
			gearClone.Position = UDim2.new(gearClone.Position.X.Scale,0,gearClone.Position.Y.Scale,0)
			toFrameChildren[1].Position = UDim2.new(toFrameChildren[1].Position.X.Scale,0,toFrameChildren[1].Position.Y.Scale,0)
			
			toFrameChildren[1].Parent = gearClone.Parent
			gearClone.Parent = toFrame
		end
	else
		local slotNum = tonumber(gearClone.SlotNumber.Text)
		if slotNum == 0 then slotNum = 10 end
		gearSlots[slotNum] = "empty" -- reset this gear slot
		
		local subString = string.sub(toFrame.Name,5)
		gearClone.SlotNumber.Text = subString
		gearClone.SlotNumberDownShadow.Text = subString
		gearClone.SlotNumberUpShadow.Text = subString
			
		local toSlotNum = tonumber(gearClone.SlotNumber.Text)
		if toSlotNum == 0 then toSlotNum = 10 end
		gearSlots[toSlotNum] = gearClone
		gearClone.Position = UDim2.new(gearClone.Position.X.Scale,0,gearClone.Position.Y.Scale,0)
		gearClone.Parent = toFrame
	end
end

function resolveDrag(gearClone,x,y)
	local mousePoint = Vector2.new(x,y)
	
	local frame = gearClone.Parent
	local frames = frame.Parent:GetChildren()
	
	for i = 1, #frames do
		if frames[i]:IsA("Frame") then
			if pointInRectangle(mousePoint, frames[i].AbsolutePosition,frames[i].AbsoluteSize) then
				swapGear(gearClone,frames[i])
				return true
			end
		end
	end
	
	if x < frame.AbsolutePosition.x or x > ( frame.AbsolutePosition.x + frame.AbsoluteSize.x ) then
		reorganizeLoadout(gearClone,false)
		return false
	elseif y < frame.AbsolutePosition.y or y > ( frame.AbsolutePosition.y + frame.AbsoluteSize.y ) then
		reorganizeLoadout(gearClone,false)
		return false
	else
		if dragBeginPos then gearClone.Position = dragBeginPos end
		return -1
	end
end

function unequipAllItems(dontEquipThis)
	for i = 1, #gearSlots do
		if gearSlots[i] == "empty" then break end
		if gearSlots[i].GearReference.Value ~= dontEquipThis then
			if gearSlots[i].GearReference.Value:IsA("HopperBin") then
				gearSlots[i].GearReference.Value:Disable()
			elseif gearSlots[i].GearReference.Value:IsA("Tool") then
				gearSlots[i].GearReference.Value.Parent = game.Players.LocalPlayer.Backpack
			end
			gearSlots[i].Selected = false
		end
	end
end

local addingPlayerChild = function(child, equipped, addToSlot, inventoryGearButton)
	waitForDebounce()
	debounce.Value = true
	
	if child:FindFirstChild("RobloxBuildTool") then debounce.Value = false return end -- don't show roblox build tools
	if not child:IsA("Tool") then
		if not child:IsA("HopperBin") then
			debounce.Value = false 
			return  -- we don't care about anything besides tools (sigh...)
		end
	end
	
	if not addToSlot then
		for i = 1, #gearSlots do
			if gearSlots[i] ~= "empty" and gearSlots[i].GearReference.Value == child then -- we already have gear, do nothing
				debounce.Value = false
				return
			end
		end
	end
	

	local gearClone = currentLoadout.TempSlot:clone()
	gearClone.Name = child.Name
	gearClone.GearImage.Image = child.TextureId
	if gearClone.GearImage.Image == "" then
		gearClone.GearText.Text = child.Name
	end
	gearClone.GearReference.Value = child

	gearClone.RobloxLocked = true

	local slotToMod = -1
	
	if not addToSlot then
		for i = 1, #gearSlots do
			if gearSlots[i] == "empty" then
				slotToMod = i
				break
			end
		end
	else
		slotToMod = addToSlot
	end
	
	if slotToMod == - 1 then debounce.Value = false print("no slots!") return end -- No available slot to add in!
	
	local slotNum = slotToMod % 10
	local parent = currentLoadout:FindFirstChild("Slot"..tostring(slotNum))
	gearClone.Parent = parent
	
	if inventoryGearButton then
		local absolutePositionFinal = inventoryGearButton.AbsolutePosition
		local currentAbsolutePosition = gearClone.AbsolutePosition
		local diff = absolutePositionFinal - currentAbsolutePosition
		gearClone.Position = UDim2.new(gearClone.Position.X.Scale,diff.x,gearClone.Position.Y.Scale,diff.y)
		gearClone.ZIndex = 4
	end
	
	if addToSlot then
		reorganizeLoadout(gearClone, true, equipped, addToSlot)
	else
		reorganizeLoadout(gearClone, true)
	end

	if gearClone.Parent == nil then debounce.Value = false return end -- couldn't fit in (hopper is full!)

	if equipped then
		gearClone.Selected = true
		unequipAllItems(child)
		delay(guiTweenSpeed + 0.01,function() -- if our gear is equipped, we will want to enlarge it when done moving
			if (gearClone.GearReference.Value:IsA("Tool") and gearClone:FindFirstChild("GearReference") and gearClone.GearReference.Value.Parent == player.Character) or
				(gearClone.GearReference.Value:IsA("HopperBin") and gearClone.GearReference.Value.Active == true) then
					enlargeButton(gearClone)
			end
		end) 
	end

	local dragBeginPos = nil
	local clickCon, buttonDeleteCon, mouseEnterCon, mouseLeaveCon, dragStop, dragBegin = nil
	clickCon = gearClone.MouseButton1Click:connect(function() if not gearClone.Draggable then activateGear(gearClone.SlotNumber.Text) end end)
	mouseEnterCon = gearClone.MouseEnter:connect(function()
		if guiBackpack.Visible then
			gearClone.Draggable = true
		end
	end)
	dragBegin = gearClone.DragBegin:connect(function(pos)
		dragBeginPos = pos
		gearClone.ZIndex = 7
		local children = gearClone:GetChildren()
		for i = 1, #children do
			if children[i]:IsA("TextLabel") then
				if string.find(children[i].Name,"Shadow") then
					children[i].ZIndex = 8
				else
					children[i].ZIndex = 9
				end
			elseif children[i]:IsA("Frame") or children[i]:IsA("ImageLabel") then
				 children[i].ZIndex = 7
			end
		end
	end)
	dragStop = gearClone.DragStopped:connect(function(x,y)
		if gearClone.Selected then
			gearClone.ZIndex = 2
		else
			gearClone.ZIndex = 1
		end
		local children = gearClone:GetChildren()
		for i = 1, #children do
			if children[i]:IsA("TextLabel") then
				if string.find(children[i].Name,"Shadow") then
					children[i].ZIndex = 3
				else
					children[i].ZIndex = 4
				end
			elseif children[i]:IsA("Frame") or children[i]:IsA("ImageLabel") then
				 children[i].ZIndex = 2
			end
		end
		resolveDrag(gearClone,x,y)
	end)
	mouseLeaveCon = gearClone.MouseLeave:connect(function()
		gearClone.Draggable = false
	end)
	buttonDeleteCon = gearClone.AncestryChanged:connect(function()
			if gearClone.Parent and gearClone.Parent.Parent == currentLoadout then return end
			if clickCon then clickCon:disconnect() end
			if buttonDeleteCon then buttonDeleteCon:disconnect() end
			if mouseEnterCon then mouseEnterCon:disconnect() end
			if mouseLeaveCon then mouseLeaveCon:disconnect() end
			if dragStop then dragStop:disconnect() end
			if dragBegin then dragBegin:disconnect() end
	end) -- this probably isn't necessary since objects are being deleted (probably), but this might still leak just in case
	
	local childCon = nil
	local childChangeCon = nil
	childCon = child.AncestryChanged:connect(function(newChild,parent)
		if not checkToolAncestry(newChild,parent) then
			if childCon then childCon:disconnect() end
			if childChangeCon then childChangeCon:disconnect() end
			removeFromInventory(child)
		elseif parent == game.Players.LocalPlayer.Backpack then
			normalizeButton(gearClone)
		end
	end)
	
	childChangeCon = child.Changed:connect(function(prop)
		if prop == "Name" then
			if gearClone and gearClone.GearImage.Image == "" then
				gearClone.GearText.Text = child.Name
			end
		end
	end)
	
	debounce.Value = false
	
end

function addToInventory(child)
	if not child:IsA("Tool") or not child:IsA("HopperBin") then return end
	
	local slot = nil
	for i = 1, #inventory do
		if inventory[i] and inventory[i] == child then return end
		if not inventory[i] then slot = i end
	end
	if slot then 
		inventory[slot] = child 
	elseif #inventory < 1 then
		inventory[1] = child
	else
		inventory[#inventory + 1] = child
	end
end

function removeFromInventory(child)
	for i = 1, #inventory do
		if inventory[i] == child then
			table.remove(inventory,i)
			inventory[i] = nil
		end
	end
end

-- these next two functions are used for safe guarding 
-- when we are waiting for character to come back after dying
function activateLoadout()
	keyPressCon = game:GetService("GuiService").KeyPressed:connect(function(key) activateGear(key) end)
	currentLoadout.Visible = true
end

function deactivateLoadout()
	if keyPressCon then keyPressCon:disconnect() end
	currentLoadout.Visible = false
end

function setupBackpackListener()
	if backpackChildCon then backpackChildCon:disconnect() end
	backpackChildCon = player.Backpack.ChildAdded:connect(function(child)
		addingPlayerChild(child)
		addToInventory(child)
	end)
end

function playerCharacterChildAdded(child)
	addingPlayerChild(child,true)
	addToInventory(child)
end
-- End Functions






-- Begin Script
wait() -- let stuff initialize incase this is first heartbeat...
	
waitForChild(player,"Backpack")
local backpackChildren = player.Backpack:GetChildren()
local size = math.min(10,#backpackChildren)
for i = 1, size do
	addingPlayerChild(backpackChildren[i],false)
end
setupBackpackListener()

waitForProperty(player,"Character")
for i,v in ipairs(player.Character:GetChildren()) do
	playerCharacterChildAdded(v)
end
characterChildAddedCon = player.Character.ChildAdded:connect(function(child) playerCharacterChildAdded(child) end)

waitForChild(player.Character,"Humanoid")
humanoidDiedCon = player.Character.Humanoid.Died:connect(function() deactivateLoadout() end)

player.CharacterRemoving:connect(function()
	if characterChildAddedCon then characterChildAddedCon:disconnect() end
	if humanoidDiedCon then humanoidDiedCon:disconnect() end
	if backpackChildCon then backpackChildCon:disconnect() end
	deactivateLoadout()
end)
player.CharacterAdded:connect(function()
	player = game.Players.LocalPlayer -- make sure we are still looking at the correct character
	
	for i = 1, #gearSlots do
		if gearSlots[i] ~= "empty" then
			gearSlots[i].Parent = nil
			gearSlots[i] = "empty"
		end
	end

	waitForChild(player,"Backpack")
	local backpackChildren = player.Backpack:GetChildren()
	local size = math.min(10,#backpackChildren)
	for i = 1, size do
		addingPlayerChild(backpackChildren[i])
	end
	
	setupBackpackListener()
	
	characterChildAddedCon = 
		player.Character.ChildAdded:connect(function(child)
			addingPlayerChild(child,true)
		end)
		
	waitForChild(player.Character,"Humanoid")
	humanoidDiedCon = 
		player.Character.Humanoid.Died:connect(function()
			deactivateLoadout()
		end)
	activateLoadout()
end)

waitForChild(guiBackpack,"SwapSlot")
guiBackpack.SwapSlot.Changed:connect(function()
	if guiBackpack.SwapSlot.Value then
		local swapSlot = guiBackpack.SwapSlot
		local pos = swapSlot.Slot.Value
		if pos == 0 then pos = 10 end
		if gearSlots[pos] then
			reorganizeLoadout(gearSlots[pos],false)
		end
		if swapSlot.GearButton.Value then
			addingPlayerChild(swapSlot.GearButton.Value.GearReference.Value,false,pos)
		end
		guiBackpack.SwapSlot.Value = false
	end
end)

keyPressCon = game:GetService("GuiService").KeyPressed:connect(function(key) activateGear(key) end)

end)
