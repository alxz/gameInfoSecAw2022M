function getAllStories() {
    return [
        { // lock your data storyId: 0 - rmCoord: { x: 3, y: 1 } topicid: 9 (PHISHING)
            storyId: 0,
            topicid: 9,
            rmCoord: { x: 3, y: 1 }, //800:520
            nextScene: 0,
            lastScene: 6,
            questCoord: {x: 450, y: 350 },
            sceneList: [
                {
                    sceneId: 0,
                    spriteId: 0,
                    objType: 'DECORATION',
                    npcName: 'compDesk1',
                    animKey: 'compDeskLock',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 280, y: 200 },
                    endXY: { x: 280, y: 200 },
                    timeFrame: 1,
                    txtLabel: 'Computer',
                    txtStr: ' Computer: z-z-z...',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'compDeskLock'
                },
                {
                    sceneId: 1,
                    spriteId: 13,
                    objType: 'DECORATION',
                    npcName: 'labChemistTabR',
                    animKey: 'labChemistTabRKey',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 620, y: 250 },
                    endXY: { x: 620, y: 250 },
                    spriteScale: 2.1, 
                    timeFrame: 1,
                    txtLabel: 'labChemistTable',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'labChemistTabRKey'
                },
                {
                    sceneId: 2,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'YellowDoc',
                    animKey: 'walkLeft',
                    moveTo: 'LEFT',
                    zIndex: 10,
                    vectorXY: { x: -1, y: 0 },
                    startXY: { x: 500, y: 200 }, //{ x: 650, y: 720 }
                    endXY: { x: 320, y: 200 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: I need to find \r\n my patient data...',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'standFace'

                },
                {
                    sceneId: 3,
                    spriteId: 0,
                    objType: 'DECORATION',
                    npcName: 'compDesk1',
                    animKey: 'compDeskLock',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 280, y: 200 },
                    endXY: { x: 280, y: 200 },
                    timeFrame: 2,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Computer: Please enter \r\n  your user name and password!',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'compDeskOpen'
                },
                {
                    sceneId: 4,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'YellowDoc',
                    animKey: 'walkLeft',
                    moveTo: 'NO',
                    zIndex: 10,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 320, y: 200 }, //{ x: 650, y: 720 }
                    endXY: { x: 320, y: 200 },
                    timeFrame: 2,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Sure, here it is! \r\n Adding some really important \r\n  patient data... Done!',
                    initRead: false,
                    removeSprite: true,
                    lastAnimKey: 'standFace'

                },
                {
                    sceneId: 5,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'YellowDoc',
                    animKey: 'walkRight',
                    moveTo: 'RIGHT',
                    zIndex: 10,
                    vectorXY: { x: 1, y: 0 },
                    startXY: { x: 320, y: 200 },
                    endXY: { x: 400, y: 200 },
                    timeFrame: 3,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Oh, its almost noon! \r\n  I need to go to \r\n  outside!',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'standFace'
                },
                {
                    sceneId: 6,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'YellowDoc',
                    animKey: 'walkDown',
                    moveTo: 'UP',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 1 },
                    startXY: { x: 400, y: 200 },
                    endXY: { x: 400, y: 50 },
                    timeFrame: 3,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: I wil be back soon \r\n  .. in a 15 minutes',
                    initRead: false,
                    removeSprite: true,
                    lastAnimKey: 'standFace'
                }
            ]
        },
        { // confidentialInfo storyId: 1 - rmCoord: { x: 3, y: 3 } topicid: 3
            storyId: 1,
            topicid: 3,
            rmCoord: { x: 3, y: 3 },
            nextScene: 0,
            lastScene: 4,
            questCoord: {x: 450, y: 300 },
            sceneList: [
                {
                    sceneId: 4,
                    spriteId: 11,
                    objType: 'DECORATION',
                    npcName: 'labsmallEqAnimDeskL',
                    animKey: 'labsmallEqAnimDeskLKey',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 250, y: 200 },
                    endXY: { x: 250, y: 200 },
                    spriteScale: 2.1, 
                    timeFrame: 1,
                    txtLabel: 'labSmallEquipment',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'labsmallEqAnimDeskLKey'
                },
                {
                    sceneId: 4,
                    spriteId: 12,
                    objType: 'DECORATION',
                    npcName: 'labbigEqAnimDeskR',
                    animKey: 'labbigEqAnimDeskRKey',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 620, y: 220 },
                    endXY: { x: 620, y: 220 },
                    spriteScale: 2.1,
                    timeFrame: 1,
                    txtLabel: 'labSmallEquipment',
                    txtStr: ' Labs ',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'labbigEqAnimDeskRKey'
                },
                {
                    sceneId: 4,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'YellowDoc',
                    animKey: 'walkRight',
                    moveTo: 'RIGHT',
                    zIndex: 10,
                    vectorXY: { x: 1, y: 0 },
                    startXY: { x: 280, y: 250 }, //{ x: 650, y: 720 }
                    endXY: { x: 500, y: 250 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Hey-hey, I\'ve got some news \r\n you wont beleive!',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'standFace'

                },
                {
                    sceneId: 4,
                    spriteId: 6,
                    objType: 'NPC',
                    npcName: 'YellowDocTwo',
                    animKey: 'walkLeft',
                    moveTo: 'LEFT',
                    zIndex: 10,
                    vectorXY: { x: 1, y: 0 },
                    startXY: { x: 600, y: 250 },
                    endXY: { x: 550, y: 250 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Oh, cool \r\n Quick! let me see',
                    initRead: false,
                    removeSprite: true,
                    lastAnimKey: 'standFace'
                },
                {
                    sceneId: 4,
                    spriteId: 6,
                    objType: 'NPC',
                    npcName: 'YellowDocTwo',
                    animKey: 'stayLeft',
                    moveTo: 'NO',
                    zIndex: 10,
                    vectorXY: { x: 1, y: 0 },
                    startXY: { x: 550, y: 250 },
                    endXY: { x: 550, y: 250 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Voila \r\n Look!',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'stayRight'
                }

            ]
        },
        { // cafeteria talks storyId: 2 - rmCoord: { x: 1, y: 3 } topicid: 2
            storyId: 2,
            topicid: 2,
            rmCoord: { x: 1, y: 3 },
            nextScene: 0,
            lastScene: 6,
            questCoord: {x: 450, y: 350 },
            sceneList: [
                {
                    sceneId: 0,
                    spriteId: 5,
                    objType: 'DECORATION',
                    npcName: 'cafeTableChairs',
                    animKey: 'cafeTableBrownWithChairs',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 550, y: 180 },
                    endXY: { x: 550, y: 180 },
                    timeFrame: 1,
                    txtLabel: 'cafeTable',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'cafeTableBrownWithChairs'
                },
                {
                    sceneId: 1,
                    spriteId: 4,
                    objType: 'DECORATION',
                    npcName: 'cafeTableFood',
                    animKey: 'cafeTableBrownWithChairFood',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 270, y: 350 },
                    endXY: { x: 270, y: 350 },
                    timeFrame: 1,
                    txtLabel: 'cafeTable',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'cafeTableBrownWithChairFood'
                },
                {
                    sceneId: 2,
                    spriteId: 25,
                    objType: 'DECORATION',
                    npcName: 'cafeTableChairs',
                    animKey: 'cafeTableBrownWithChairs',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 250, y: 180 },
                    endXY: { x: 250, y: 180 },
                    timeFrame: 1,
                    txtLabel: 'cafeTable',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'cafeTableBrownWithChairs'
                },
                {
                    sceneId: 3,
                    spriteId: 26,
                    objType: 'DECORATION',
                    npcName: 'cafeTableChairs',
                    animKey: 'cafeTableBrownWithChairs',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 500, y: 360 },
                    endXY: { x: 500, y: 360 },
                    timeFrame: 1,
                    txtLabel: 'cafeTable',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'cafeTableBrownWithChairs'
                },
                {
                    sceneId: 4,
                    spriteId: 6,
                    objType: 'NPC',
                    npcName: 'YellowDocTwo',
                    animKey: 'walkLeft',
                    moveTo: 'LEFT',
                    zIndex: 10,
                    vectorXY: { x: -1, y: 0 },
                    startXY: { x: 450, y: 350 }, //{ x: 650, y: 720 }
                    endXY: { x: 300, y: 350 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Take some coffee  \r\n and some food',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'standFace'

                },
                {
                    sceneId: 5,
                    spriteId: 6,
                    objType: 'NPC',
                    npcName: 'YellowDocTwo',
                    animKey: 'standFace',
                    moveTo: 'NO',
                    zIndex: 10,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 300, y: 350 },
                    endXY: { x: 300, y: 350 },
                    timeFrame: 1,
                    txtLabel: 'EmplSpeech',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'standFace'

                },
                {
                    sceneId: 6,
                    spriteId: 7,
                    objType: 'NPC',
                    npcName: 'DocWalk4w',
                    animKey: 'walkRight',
                    moveTo: 'RIGHT',
                    zIndex: 10,
                    vectorXY: { x: 1, y: 0 },
                    startXY: { x: 220, y: 350 },
                    endXY: { x: 250, y: 350 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Hey dude! \r\n Wanna see something funny?! \r\n Look at this pictures!',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'faceUp'
                }
            ]
        },
        { // computer desk - storyId: 3 - rmCoord: { x: 2, y: 3 } - topicid: 4
            storyId: 3,
            topicid: 9,
            rmCoord: { x: 2, y: 3 },
            nextScene: 0,
            lastScene: 5,
            questCoord: { x: 450, y: 350 },
            decorXY: { x: 300, y: 160} ,
            sceneList: [
                {
                    sceneId: 0,
                    spriteId: 10,
                    objType: 'DECORATION',
                    npcName: 'compDeskScrBlank',
                    animKey: 'compScrBlank',
                    moveTo: 'NO',
                    zIndex: 0,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 300, y: 160 },
                    endXY: { x: 300, y: 160 },
                    timeFrame: 0,
                    txtLabel: 'compScrBlank',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'compScrBlank'
                },
                {
                    sceneId: 1,
                    spriteId: 14,
                    objType: 'DECORATION',
                    npcName: 'labChemistTabR',
                    animKey: 'labChemistTabRKey',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 400, y: 450 },
                    endXY: { x: 400, y: 450 },
                    spriteScale: 2.1, 
                    timeFrame: 1,
                    txtLabel: 'labChemistTable',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'labChemistTabRKey'
                },
                {
                    sceneId: 2,
                    spriteId: 7,
                    objType: 'NPC',
                    npcName: 'DocWalk4w',
                    animKey: 'walkLeft',
                    moveTo: 'LEFT',
                    zIndex: 10,
                    vectorXY: { x: -1, y: 0 },
                    startXY: { x: 500, y: 350 }, //{ x: 650, y: 720 }
                    endXY: { x: 350, y: 350 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Let\'s check my email',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'walkLeft'

                },
                {
                    sceneId: 3,
                    spriteId: 7,
                    objType: 'NPC',
                    npcName: 'DocWalk4w',
                    animKey: 'walkUp',
                    moveTo: 'UP',
                    zIndex: 10,
                    vectorXY: { x: 0, y: -1 },
                    startXY: { x: 350, y: 350 }, //{ x: 650, y: 720 }
                    endXY: { x: 350, y: 200 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Seems to be somethings interesting...',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'faceBack'
                },
                {
                    sceneId: 4,
                    spriteId: 9,
                    objType: 'DECORATION',
                    npcName: 'compScreen6pcs',
                    animKey: 'compScrLoading',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 300, y: 140 },
                    endXY: { x: 300, y: 140 },
                    timeFrame: 5,
                    txtLabel: 'compScreenOpen',
                    txtStr: ' Email program: A new message has arrived!',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'compScrLoading'
                },
                {
                    sceneId: 5,
                    spriteId: 9,
                    objType: 'DECORATION',
                    npcName: 'compScreen6pcs',
                    animKey: 'compScrImportntMsg',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 300, y: 140 },
                    endXY: { x: 300, y: 140 },
                    timeFrame: 5,
                    txtLabel: 'compScreenOpen',
                    txtStr: ' Email program: The message is from your bank',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'compScrImportntMsg'
                }
            ]
        },
        { // scientistTable - storyId: 4 - rmCoord: { x: 0, y: 2 } topicid: 7
            storyId: 4,
            topicid: 7,
            rmCoord: { x: 0, y: 2 },
            nextScene: 0,
            lastScene: 5,
            questCoord: { x: 400, y: 300 },
            decorXY: { x: 400, y: 200} ,            
            sceneList: [
                {
                    sceneId: 0,
                    spriteId: 0,
                    objType: 'DECORATION',
                    npcName: 'scientistTable',
                    animKey: 'scientistTableAnimated',
                    moveTo: 'NO',
                    zIndex: 11,
                    spriteScale: 1.5,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 400, y: 380 },
                    endXY: { x: 400, y: 380 },
                    timeFrame: 0,
                    txtLabel: 'scientistTable',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'scientistTableAnimated'
                },
                {
                    sceneId: 1,
                    spriteId: 19,
                    objType: 'DECORATION',
                    npcName: 'labChemistTabL',
                    animKey: 'labChemistTabLKey',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 160, y: 250 },
                    endXY: { x: 160, y: 250 },
                    spriteScale: 2.2,
                    timeFrame: 1,
                    txtLabel: 'labChemistTable',
                    txtStr: ' Labs ',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'labChemistTabLKey'
                },
                {
                    sceneId: 2,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'ScientistPassword',
                    animKey: 'ScientistWalkLeft',
                    moveTo: 'LEFT',
                    zIndex: 10,
                    spriteScale: 1,
                    vectorXY: { x: -.5, y: 0 },
                    startXY: { x: 450, y: 350 }, //{ x: 650, y: 720 }
                    endXY: { x: 300, y: 350 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: I need to create \r\n A strong password!',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'ScientistWalkLeft'
                },
                {
                    sceneId: 3,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'ScientistPassword',
                    animKey: 'ScientistWalkRight',
                    moveTo: 'RIGHT',
                    zIndex: 10,
                    spriteScale: 1,
                    vectorXY: { x: +.5, y: 0 },
                    startXY: { x: 300, y: 350 }, //{ x: 650, y: 720 }
                    endXY: { x: 420, y: 350 },
                    timeFrame: 3,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: This software \r\n wont work without it !',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'ScientistWalkRight'
                },
                {
                    sceneId: 4,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'ScientistPassword',
                    animKey: 'ScientistWalkLeft',
                    moveTo: 'LEFT',
                    zIndex: 10,
                    spriteScale: 1,
                    vectorXY: { x: -.5, y: 0 },
                    startXY: { x: 420, y: 350 },
                    endXY: { x: 400, y: 350 },
                    timeFrame: 3,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: I need to create \r\n A strong password!',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'ScientistWalkLeft'
                },
                {
                    sceneId: 5,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'ScientistPassword',
                    animKey: 'docAlEinstTypingFW',
                    moveTo: 'NO',
                    zIndex: 10,
                    spriteScale: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 400, y: 360 },
                    endXY: { x: 400, y: 360 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: 'Employee: Could you please help me\r\n with the strong password creation?',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'docAlEinstTypingFW'
                }
            ]
        },
        { // confidentialInfo storyId: 5 - rmCoord: { x: 0, y: 1 } topicid: 5
            storyId: 5,
            topicid: 5,
            rmCoord: { x: 0, y: 1 },
            nextScene: 0,
            lastScene: 2,
            questCoord: {x: 450, y: 300 },
            sceneList: [
                {
                    sceneId: 0,
                    spriteId: 11,
                    objType: 'DECORATION',
                    npcName: 'labsmallEqAnimDeskL',
                    animKey: 'labsmallEqAnimDeskLKey',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 250, y: 200 },
                    endXY: { x: 250, y: 200 },
                    spriteScale: 2.1, 
                    timeFrame: 1,
                    txtLabel: 'labSmallEquipment',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'labsmallEqAnimDeskLKey'
                },
                {
                    sceneId: 1,
                    spriteId: 12,
                    objType: 'DECORATION',
                    npcName: 'labbigEqAnimDeskR',
                    animKey: 'labbigEqAnimDeskRKey',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 620, y: 220 },
                    endXY: { x: 620, y: 220 },
                    spriteScale: 2.1,
                    timeFrame: 1,
                    txtLabel: 'labSmallEquipment',
                    txtStr: ' Labs ',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'labbigEqAnimDeskRKey'
                },
                {
                    sceneId: 2,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'YellowDoc',
                    animKey: 'walkRight',
                    moveTo: 'RIGHT',
                    zIndex: 10,
                    vectorXY: { x: 1, y: 0 },
                    startXY: { x: 280, y: 250 }, //{ x: 650, y: 720 }
                    endXY: { x: 500, y: 250 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Hey-hey, I\'ve got some news \r\n you wont beleive!',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'standFace'
                }
            ]
        },
        { // confidentialInfo storyId: 6 - rmCoord: { x: 3, y: 2 } topicid: 6
            storyId: 6,
            topicid: 6,
            rmCoord: { x: 3, y: 2 },
            nextScene: 0,
            lastScene: 2,
            questCoord: {x: 450, y: 300 },
            sceneList: [
                {
                    sceneId: 0,
                    spriteId: 14,
                    objType: 'DECORATION',
                    npcName: 'labChemistTabR',
                    animKey: 'labChemistTabRKey',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 600, y: 200 },
                    endXY: { x: 600, y: 200 },
                    spriteScale: 2.1, 
                    timeFrame: 1,
                    txtLabel: 'labChemistTable',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'labChemistTabRKey'
                },
                {
                    sceneId: 1,
                    spriteId: 15,
                    objType: 'DECORATION',
                    npcName: 'labChemistTabL',
                    animKey: 'labChemistTabLKey',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 220, y: 220 },
                    endXY: { x: 220, y: 220 },
                    spriteScale: 2.2,
                    timeFrame: 1,
                    txtLabel: 'labChemistTable',
                    txtStr: ' Labs ',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'labChemistTabLKey'
                },
                {
                    sceneId: 2,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'YellowDoc',
                    animKey: 'walkRight',
                    moveTo: 'RIGHT',
                    zIndex: 10,
                    vectorXY: { x: 1, y: 0 },
                    startXY: { x: 280, y: 250 }, //{ x: 650, y: 720 }
                    endXY: { x: 500, y: 250 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Hello!',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'standFace'

                }

            ]
        },
        { // confidentialInfo storyId: 7 - rmCoord: { x: 1, y: 2 } topicid: 8
            storyId: 7,
            topicid: 8,
            rmCoord: { x: 1, y: 2 },
            nextScene: 0,
            lastScene: 2,
            questCoord: {x: 450, y: 300 },
            sceneList: [
                {
                    sceneId: 0,
                    spriteId: 16,
                    objType: 'DECORATION',
                    npcName: 'labChemistTabR',
                    animKey: 'labChemistTabRKey',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 600, y: 190 },
                    endXY: { x: 600, y: 190 },
                    spriteScale: 2.1, 
                    timeFrame: 1,
                    txtLabel: 'labChemistTable',
                    txtStr: '',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'labChemistTabRKey'
                },
                {
                    sceneId: 1,
                    spriteId: 17,
                    objType: 'DECORATION',
                    npcName: 'labChemistTabL',
                    animKey: 'labChemistTabLKey',
                    moveTo: 'NO',
                    zIndex: 1,
                    vectorXY: { x: 0, y: 0 },
                    startXY: { x: 220, y: 220 },
                    endXY: { x: 220, y: 220 },
                    spriteScale: 2.2,
                    timeFrame: 1,
                    txtLabel: 'labChemistTable',
                    txtStr: ' Labs ',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'labChemistTabLKey'
                },
                {
                    sceneId: 2,
                    spriteId: 1,
                    objType: 'NPC',
                    npcName: 'YellowDoc',
                    animKey: 'walkLeft',
                    moveTo: 'LEFT',
                    zIndex: 10,
                    vectorXY: { x: -1, y: 0 },
                    startXY: { x: 500, y: 260 }, //{ x: 650, y: 720 }
                    endXY: { x: 300, y: 260 },
                    timeFrame: 5,
                    txtLabel: 'EmplSpeech',
                    txtStr: ' Employee: Hello!',
                    initRead: false,
                    removeSprite: false,
                    lastAnimKey: 'standFace'

                }

            ]
        }
    ]
}

function getSceneSprites(coordX, coordY) {
    return [
        { // sceneId: 0
            sceneId: 0,
            sceneName: 'lockYourComputer',
            cCoordX : coordX,
            cCoordY : coordY,
            animNPCGroup : [
                {
                    id: 0,
                    isActive: false,
                    objType: 'DECORATION',
                    npcName: 'compDesk1',
                    defaultKey: 'compDeskLock',
                    npcCoordX : (280),
                    npcCoordY : (720),
                    zIndex: 0,
                    animList: [
                        {
                            key: 'compDeskOpen',
                            frames: { spriteName: 'compDesk4x4', start: 0, end: 3 },
                            frameRate: 5,
                            repeat: 10
                        },
                        {
                            key: 'compDeskLock',
                            frames: { spriteName: 'compDesk4x4', start: 4, end: 7 },
                            frameRate: 5,
                            repeat: 10
                        }
                    ]
                },
                {
                    id: 1,
                    isActive: true,
                    objType: 'NPC',
                    npcName: 'YellowDoc',
                    defaultKey: 'standFace',
                    npcCoordX : (650),
                    npcCoordY : (720),
                    zIndex: 10,
                    animList: [
                        {
                            key: 'standFace',
                            frames: { spriteName: 'docAlEinstStand', start: 0, end: 0 },
                            frameRate: 1,
                            repeat: -1
                        },
                        {
                            key: 'walkUp',
                            frames: { spriteName: 'docAlEinst', start: 4, end: 7 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'walkDown',
                            frames: { spriteName: 'docAlEinst', start: 8, end: 11 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'walkLeft',
                            frames: { spriteName: 'docAlEinst', start: 0, end: 3 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'walkRight',
                            frames: { spriteName: 'docAlEinst', start: 12, end: 15 },
                            frameRate: 5,
                            repeat: -1
                        }
                    ]
                },
                {
                    id: 4,
                    isActive: false,
                    objType: 'DECORATION',
                    npcName: 'cafeTableFood',
                    defaultKey: 'cafeTableBrownWithChairFood',
                    npcCoordX : (650),
                    npcCoordY : (860),
                    zIndex: 0,
                    animList: [
                        {
                            key: 'cafeTableBrownEmpty',
                            frames: { spriteName: 'cafeTableBrown', start: 0, end: 0 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'cafeTableBrownWithChairs',
                            frames: { spriteName: 'cafeTableBrown', start: 1, end: 1 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'cafeTableBrownWithChairFood',
                            frames: { spriteName: 'cafeTableBrown', start: 2, end: 2 },
                            frameRate: 5,
                            repeat: 1
                        }
                    ]
                },
                {
                    id: 5,
                    isActive: false,
                    objType: 'DECORATION',
                    npcName: 'cafeTableChairs',
                    defaultKey: 'cafeTableBrownWithChairs',
                    npcCoordX : (100),
                    npcCoordY : (100),
                    zIndex: 0,
                    animList: [
                        {
                            key: 'cafeTableBrownEmpty',
                            frames: { spriteName: 'cafeTableBrown', start: 0, end: 0 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'cafeTableBrownWithChairs',
                            frames: { spriteName: 'cafeTableBrown', start: 1, end: 1 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'cafeTableBrownWithChairFood',
                            frames: { spriteName: 'cafeTableBrown', start: 2, end: 2 },
                            frameRate: 5,
                            repeat: 1
                        }
                    ]
                },
                {
                    id: 6,
                    isActive: true,
                    objType: 'NPC',
                    npcName: 'YellowDocTwo',
                    defaultKey: 'standFace',
                    npcCoordX : (650),
                    npcCoordY : (720),
                    zIndex: 10,
                    animList: [
                        {
                            key: 'standFace',
                            frames: { spriteName: 'docAlEinstStand', start: 0, end: 0 },
                            frameRate: 1,
                            repeat: 1
                        },
                        {
                            key: 'stayUp',
                            frames: { spriteName: 'docAlEinst', start: 4, end: 4 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'stayDown',
                            frames: { spriteName: 'docAlEinst', start: 8, end: 8 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'stayLeft',
                            frames: { spriteName: 'docAlEinst', start: 0, end: 0 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'stayRight',
                            frames: { spriteName: 'docAlEinst', start: 12, end: 12 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'walkLeft',
                            frames: { spriteName: 'docAlEinst', start: 0, end: 3 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'walkRight',
                            frames: { spriteName: 'docAlEinst', start: 12, end: 15 },
                            frameRate: 5,
                            repeat: -1
                        }
                    ]
                },
                {
                    id: 7,
                    isActive: true,
                    objType: 'NPC',
                    npcName: 'DocWalk4w',
                    defaultKey: 'faceUp',
                    npcCoordX : (650),
                    npcCoordY : (320),
                    zIndex: 10,
                    animList: [
                        {
                            key: 'faceUp',
                            frames: { spriteName: 'docWalk4w', start: 4, end: 4 },
                            frameRate: 1,
                            repeat: 1
                        },
                        {
                            key: 'faceBack',
                            frames: { spriteName: 'docWalk4w', start: 8, end: 8 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'stayLeft',
                            frames: { spriteName: 'docWalk4w', start: 2, end: 2 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'stayRight',
                            frames: { spriteName: 'docWalk4w', start: 13, end: 13 },
                            frameRate: 5,
                            repeat: 0
                        },
                        {
                            key: 'walkUp',
                            frames: { spriteName: 'docWalk4w', start: 8, end: 11 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'walkDown',
                            frames: { spriteName: 'docWalk4w', start: 4, end: 7 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'walkLeft',
                            frames: { spriteName: 'docWalk4w', start: 0, end: 3 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'walkRight',
                            frames: { spriteName: 'docWalk4w', start: 12, end: 15 },
                            frameRate: 5,
                            repeat: -1
                        }
                    ]
                },
                {
                    id: 8,
                    isActive: false,
                    objType: 'DECORATION',
                    npcName: 'compDesk2',
                    defaultKey: 'compDeskLock',
                    npcCoordX : (480),
                    npcCoordY : (720),
                    zIndex: 1,
                    animList: [
                        {
                            key: 'compDeskOpen',
                            frames: { spriteName: 'compDesk4x4', start: 0, end: 3 },
                            frameRate: 5,
                            repeat: 10
                        },
                        {
                            key: 'compDeskLock',
                            frames: { spriteName: 'compDesk4x4', start: 4, end: 7 },
                            frameRate: 5,
                            repeat: 10
                        }
                    ]
                },
                {
                    id: 9,
                    isActive: false,
                    objType: 'DECORATION',
                    npcName: 'compScreen6pcs',
                    defaultKey: 'compScrLoading',
                    npcCoordX : (480),
                    npcCoordY : (720),
                    zIndex: 0,
                    animList: [
                        {
                            key: 'compScrLoading',
                            frames: { spriteName: 'ComputerScreenSet6', start: 0, end: 0 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'compScrImportntMsg',
                            frames: { spriteName: 'ComputerScreenSet6', start: 1, end: 1 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'compScrLoadingHDeskMsg',
                            frames: { spriteName: 'ComputerScreenSet6', start: 2, end: 2 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'compScrLoadingUserPw',
                            frames: { spriteName: 'ComputerScreenSet6', start: 3, end: 4 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'compScreenFinal',
                            frames: { spriteName: 'ComputerScreenSet6', start: 5, end: 5 },
                            frameRate: 5,
                            repeat: 0
                        }
                    ]
                },
                {
                    id: 10,
                    isActive: false,
                    objType: 'DECORATION',
                    npcName: 'compDeskScrBlank',
                    defaultKey: 'compScrBlank',
                    npcCoordX : (480),
                    npcCoordY : (720),
                    zIndex: 0,
                    animList: [
                        {
                            key: 'compScrGrey',
                            frames: { spriteName: 'compDeskScrBlank', start: 1, end: 1 },
                            frameRate: 5,
                            repeat: 1
                        },
                        {
                            key: 'compScrBlank',
                            frames: { spriteName: 'compDeskScrBlank', start: 0, end: 0 },
                            frameRate: 5,
                            repeat: 1
                        }
                    ]
                }
            ],
            animTextIndex: 0,
            animTextMaxIndex: 3
        },
        { // sceneId: 3
            sceneId: 3,
            sceneName: 'makeStrongPassword',
            cCoordX : coordX,
            cCoordY : coordY,
            animNPCGroup : [
                {
                    id: 0,
                    isActive: false,
                    objType: 'DECORATION',
                    npcName: 'scientistTable',
                    defaultKey: 'scientistTable',
                    npcCoordX : (680),
                    npcCoordY : (400),
                    zIndex: 0,
                    animList: [
                        {
                            key: 'scientistTableStill',
                            frames: { spriteName: 'scientistTable', start: 0, end: 0 },
                            frameRate: 1,
                            repeat: -1
                        },
                        {
                            key: 'scientistTableAnimated',
                            frames: { spriteName: 'scientistTable', start: 0, end: 5 },
                            frameRate: 6,
                            repeat: -1
                        }
                    ]
                },
                {
                    id: 1,
                    isActive: true,
                    objType: 'NPC',
                    npcName: 'ScientistPassword',
                    defaultKey: 'ScientistStandFaceFW',
                    npcCoordX : (650),
                    npcCoordY : (380),
                    zIndex: 10,
                    animList: [ 
                        {
                            key: 'ScientistStandFaceFW',
                            frames: { spriteName: 'docAlEinstStand', start: 0, end: 0 },
                            frameRate: 1,
                            repeat: -1
                        },
                        {
                            key: 'docAlEinstTypingFW',
                            frames: { spriteName: 'docAlEinstTypingFW', start: 0, end: 5 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'ScientistWalkUp',
                            frames: { spriteName: 'docAlEinst', start: 4, end: 7 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'ScientistWalkDown',
                            frames: { spriteName: 'docAlEinst', start: 8, end: 11 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'ScientistWalkLeft',
                            frames: { spriteName: 'docAlEinst', start: 0, end: 3 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'ScientistWalkRight',
                            frames: { spriteName: 'docAlEinst', start: 12, end: 15 },
                            frameRate: 5,
                            repeat: -1
                        }
                    ]
                }
            ],
            animTextIndex: 0,
            animTextMaxIndex: 3
        },
        { // sceneId: 4
            sceneId: 4,
            sceneName: 'confidentialInfo',
            cCoordX : coordX,
            cCoordY : coordY,
            animNPCGroup : [
                {
                    id: 0,
                    isActive: false,
                    objType: 'DECORATION',
                    npcName: 'labbigEqAnimDeskR',
                    defaultKey: 'labbigEqAnimDeskRKey',
                    npcCoordX : (280),
                    npcCoordY : (400),
                    zIndex: 0,
                    animList: [
                        {
                            key: 'labbigEqAnimDeskRKeyStill',
                            frames: { spriteName: 'labbigEqAnimDeskR', start: 0, end: 0 },
                            frameRate: 1,
                            repeat: -1
                        },
                        {
                            key: 'labbigEqAnimDeskRKey',
                            frames: { spriteName: 'labbigEqAnimDeskR', start: 0, end: 5 },
                            frameRate: 6,
                            repeat: -1
                        }
                    ]
                },
                {
                    id: 1,
                    isActive: true,
                    objType: 'NPC',
                    npcName: 'labsmallEqAnimDeskL', 
                    defaultKey: 'labsmallEqAnimDeskLKey', 
                    npcCoordX : (650),
                    npcCoordY : (380),
                    zIndex: 10,
                    animList: [ 
                        {
                            key: 'labsmallEqAnimDeskLStillKey',
                            frames: { spriteName: 'labsmallEqAnimDeskL', start: 0, end: 0 },
                            frameRate: 1,
                            repeat: -1
                        },
                        {
                            key: 'labsmallEqAnimDeskLKey',
                            frames: { spriteName: 'labsmallEqAnimDeskL', start: 0, end: 5 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'ScientistWalkUp',
                            frames: { spriteName: 'docAlEinst', start: 4, end: 7 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'ScientistWalkDown',
                            frames: { spriteName: 'docAlEinst', start: 8, end: 11 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'ScientistWalkLeft',
                            frames: { spriteName: 'docAlEinst', start: 0, end: 3 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'ScientistWalkRight',
                            frames: { spriteName: 'docAlEinst', start: 12, end: 15 },
                            frameRate: 5,
                            repeat: -1
                        }
                    ]
                }
            ],
            animTextIndex: 0,
            animTextMaxIndex: 3
        },
        { // sceneId: 6
            sceneId: 6,
            sceneName: 'infoClassification',
            cCoordX : coordX,
            cCoordY : coordY,
            animNPCGroup : [
                {
                    id: 0,
                    isActive: false,
                    objType: 'DECORATION',
                    npcName: 'labChemistTabR',
                    defaultKey: 'labChemistTabRKey',
                    npcCoordX : (280),
                    npcCoordY : (400),
                    zIndex: 0,
                    animList: [
                        {
                            key: 'labChemistTabRKeyStill',
                            frames: { spriteName: 'labChemistTabR', start: 0, end: 0 },
                            frameRate: 1,
                            repeat: -1
                        },
                        {
                            key: 'labChemistTabRKey',
                            frames: { spriteName: 'labChemistTabR', start: 0, end: 5 },
                            frameRate: 6,
                            repeat: -1
                        }
                    ]
                },
                {
                    id: 1,
                    isActive: false,
                    objType: 'DECORATION',
                    npcName: 'labChemistTabL',
                    defaultKey: 'labChemistTabLKey',
                    npcCoordX : (280),
                    npcCoordY : (400),
                    zIndex: 0,
                    animList: [
                        {
                            key: 'labChemistTabLKeyStill',
                            frames: { spriteName: 'labChemistTabL', start: 0, end: 0 },
                            frameRate: 1,
                            repeat: -1
                        },
                        {
                            key: 'labChemistTabLKey',
                            frames: { spriteName: 'labChemistTabL', start: 0, end: 5 },
                            frameRate: 6,
                            repeat: -1
                        }
                    ]
                },
                {
                    id: 2,
                    isActive: true,
                    objType: 'NPC',
                    npcName: 'labChemistScientistWalkLR', 
                    defaultKey: 'ScientistWalkLeft', 
                    npcCoordX : (650),
                    npcCoordY : (380),
                    zIndex: 10,
                    animList: [                         
                        {
                            key: 'ScientistWalkLeft',
                            frames: { spriteName: 'docAlEinst', start: 0, end: 3 },
                            frameRate: 5,
                            repeat: -1
                        },
                        {
                            key: 'ScientistWalkRight',
                            frames: { spriteName: 'docAlEinst', start: 12, end: 15 },
                            frameRate: 5,
                            repeat: -1
                        }
                    ]
                }
            ],
            animTextIndex: 0,
            animTextMaxIndex: 3
        }
    ]
}

function story_src_selector(storyId) {
/*
    // by suing storyDispOut.storyId
    switch(storyId) {
        case 4:
            console.log("story_src_selector(storyId) where storyId = ", storyId);
            pass_sort_lists();

            break;                    
        default:
          // code block
    }
*/    
}

function selectAndBuildStoyById(keyObj) {
//     // build a story based on storyID
//     var id = keyObj.storyId;
//     var isResolved = keyObj.isResolved;
//     var storyDispOut = {};
//     var decorTopHTML = "";
//     switch(id) {
//         case 0:
//           // code block
//           console.log('!-!-! Func(selectAndBuildStoyById) Story ID = ', id );
//           decorTopHTML = '<div id="decorContent" class="questionDecorContent"><h1>Placeholder for the story ID = ' + id + ' </h1></div>';
//           storyDispOut = { miniGame: false };
//           storyDispOut.storyId = id;
//           storyDispOut.activeContentHTML = decorTopHTML;
//           break;
//         case 1:
//           // code block
//           console.log('!-!-! Func(selectAndBuildStoyById) Story ID = ', id );
//           decorTopHTML = '<div id="decorContent" class="questionDecorContent"><h1>Placeholder for the story ID = ' + id + ' </h1></div>';
//           storyDispOut = { miniGame: false };
//           storyDispOut.storyId = id;
//           storyDispOut.activeContentHTML = decorTopHTML;
//           break;
//         case 2:
//           // code block
//           console.log('!-!-! Func(selectAndBuildStoyById) Story ID = ', id );
//           decorTopHTML = '<div id="decorContent" class="questionDecorContent"><h1>Placeholder for the story ID = ' + id + ' </h1></div>';
//           storyDispOut = { miniGame: false };
//           storyDispOut.storyId = id;
//           storyDispOut.activeContentHTML = decorTopHTML;
//           break;          
//         case 3:
//           // code block
//           console.log('!-!-! Func(selectAndBuildStoyById) Story ID = ', id );
//           decorTopHTML = '<div id="decorContent" class="questionDecorContent"><h1>Placeholder for the story ID = ' + id + ' </h1></div>';
//           storyDispOut = { miniGame: false };
//           storyDispOut.storyId = id;
//           storyDispOut.activeContentHTML = decorTopHTML;
//           break;
//         case 4:
//             // Strong Password mini-Game:
//             /*
//             console.log('!-!-! Func(selectAndBuildStoyById) Story ID = ', id);
//             storyDispOut.storyId = id;
//             storyDispOut = { miniGame: true };
//             var outputArr = [];
//             decorTopHTML = pass_buildDrgDrpUI(); // building part of the story scene (HTML) template
//             outputArr.push(decorTopHTML);
//             storyDispOut.activeContentHTML = decorTopHTML;
//             pass_show_miniGameUI(outputArr, keyObj);
//             */
//           console.log('!-!-! Func(selectAndBuildStoyById) Story ID = ', id );
//           decorTopHTML = '<div id="decorContent" class="questionDecorContent"><h1>Placeholder for the story ID = ' + id + ' </h1></div>';
//           storyDispOut = { miniGame: false };
//           storyDispOut.storyId = id;
//           storyDispOut.activeContentHTML = decorTopHTML;
            
//           break;                    
//         default:
//           // code block by default: no story found
//           console.log('!-!-! Func(selectAndBuildStoyById) NOT FOUND Story ID = ', id, " storyDispOut: ", storyDispOut );
//           storyDispOut = null;
//       }
//     return storyDispOut;
}