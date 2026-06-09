TITLE lab3.2c
; Author: Lam Yoke Yu& Tan Yi Ya
; Date: 27 June 2024
include Irvine32.inc

.data
	welcomeMsg BYTE "Welcome to Simple Math Activities: ", 0dh, 0ah, 0
	menuMsg BYTE "Main Menu: ", 0dh, 0ah, 0
	menu1 BYTE "1. To calculate Perimeter Hexagon (LOOP and ADD instructions)", 0dh, 0ah, 0
	menu2 BYTE "2. To calculate SUM (unsign int) index (Odd or Even) in an Array Matric", 0dh, 0ah, 0
	selectPrompt BYTE "Select Your Input: ", 0
	errorMsg BYTE "Invalid Input...", 0dh, 0ah, 0
	continueInput BYTE ?
	continuePrompt BYTE "Press 'y' to Main Menu or 'n' to Exit: ", 0
	selectInput BYTE ?
	thankYouMsg BYTE "Thank you... BYE!!!", 0dh, 0ah, 0

	hexagonMsg BYTE "Calculate Perimeter 2-Hexagon (LOOP and ADD instructions) : ", 0
	inputPrompt1 BYTE "Input Hexagon 1 (side length) : ", 0
	inputPrompt2 BYTE "Input Hexagon 2 (side length) : ", 0
	hexagonResultMsg BYTE "Result of Perimeter Hexagon 1 and 2 : ", 0
	totalStr BYTE "Total Perimeter Hexagon 1 and 2 : ", 0
	errorPrompt BYTE "Error: Please enter a valid integer.", 0
	sideHex1 DWORD ?
	sideHex2 DWORD ?
	perimeterHexagon1 DWORD 0
	perimeterHexagon2 DWORD 0
	totalPerimeter DWORD 0

	arrayMsg BYTE "Calculate SUM (unsign INT) index (Odd or Even) in array Hello[6] : ", 0
	inputPrompt BYTE "Integer Input : ", 0
	arrayResultMsg BYTE "Result Sum Hello[index]: ", 0
	sumEvenStr BYTE "Sum Hello[even] index location : ", 0
	sumOddStr BYTE "Sum Hello[ood] index location : ", 0
	hello DWORD 6 DUP(? )
	totalEven DWORD 0
	totalOdd DWORD 0
	
.code
main proc
	MENU:
		call clrscr
		mov EDX, OFFSET welcomeMsg
		call WriteString
		call crlf

	SUBMENU:
		mov EDX, OFFSET menuMsg
		call WriteString
		call crlf

		mov EDX, OFFSET menu1
		call WriteString
		mov EDX, OFFSET menu2
		call WriteString
		call crlf

		mov EDX, OFFSET selectPrompt
		call WriteString
		call ReadDec
		mov selectInput, AL

		CMP selectInput, 1
		JE HEXAGON

		CMP selectInput, 2
		JE ARRAY

		mov EDX, OFFSET errorMsg
		call WriteString
		call crlf
		jmp SUBMENU

	HEXAGON:
		call clrscr
		mov EDX, OFFSET hexagonMsg
		call WriteString
		call crlf
		call crlf
		; Reset Variables
		mov perimeterHexagon1, 0
		mov perimeterHexagon2, 0
		mov totalPerimeter, 0
		
		; Input Hexagon 1
		INPUTHEX1:
			mov EDX, OFFSET inputPrompt1
			call WriteString
			call ReadDec
			jc INPUTHEX1ERROR
			cmp EAX, 0
			je INPUTHEX1ERROR
			mov sideHex1, EAX
			jmp INPUTHEX2
		INPUTHEX1ERROR:
			mov EDX, OFFSET errorPrompt
			call WriteString
			call crlf
			jmp INPUTHEX1

		; Input Hexagon 2
		INPUTHEX2:
			mov EDX, OFFSET inputPrompt2
			call WriteString
			call ReadDec
			jc INPUTHEX2ERROR
			cmp EAX, 0
			je INPUTHEX2ERROR
			mov sideHex2, EAX
			call crlf
			jmp CALCULATEPERIMETERS
		INPUTHEX2ERROR:
			mov EDX, OFFSET errorPrompt
			call WriteString
			call crlf
			jmp INPUTHEX2

		CALCULATEPERIMETERS:
			mov ECX, 6

		HEXAGON_ADDITION:
			mov EAX, sideHex1
			add perimeterHexagon1, EAX
			mov EAX, sideHex2
			add perimeterHexagon2, EAX
			loop HEXAGON_ADDITION

		; Display Results
		mov EDX, OFFSET hexagonResultMsg
		call WriteString
		call crlf
		mov EAX, perimeterHexagon1
		call WriteDec
		call crlf
		mov EAX, perimeterHexagon2
		call WriteDec
		call crlf
		call crlf

		mov EAX, perimeterHexagon1
		add totalPerimeter, EAX
		mov EAX, perimeterHexagon2
		add totalPerimeter, EAX

		mov EDX, OFFSET totalStr
		call WriteString
		mov EAX, totalPerimeter
		call WriteDec
		call crlf
		call crlf
		jmp CONTINUE

	ARRAY:
		call clrscr
		mov EDX, OFFSET arrayMsg
		call WriteString
		call crlf
		call crlf
		; Reset Variables
		mov totalEven, 0
		mov totalOdd, 0

		mov ECX, 6
		mov EBX, 0
		jmp INPUT

		INPUTERROR:
			mov EDX, OFFSET errorPrompt
			call WriteString
			call crlf

		INPUT:
			mov EDX, OFFSET inputPrompt
			call WriteString
			call ReadDec
			jc INPUTERROR
			cmp EAX, 0
			je INPUTERROR
			mov hello[EBX], EAX
			add EBX, 4
			loop INPUT

		call crlf
		mov ECX, 3
		mov EBX, 0

		ARRAY_ADDITION:
			mov EAX, hello[EBX]
			add totalEven, EAX
			add EBX, 4
			mov EAX, hello[EBX]
			add	totalOdd, EAX
			add EBX, 4
			loop ARRAY_ADDITION

		; Display Result
		mov EDX, OFFSET arrayResultMsg
		call WriteString
		call crlf
		call crlf

		mov EDX, OFFSET sumEvenStr
		call WriteString
		mov EAX, totalEven
		call WriteDec
		call crlf

		mov EDX, OFFSET sumOddStr
		call WriteString
		mov EAX, totalOdd
		call WriteDec
		call crlf
		call crlf
		jmp CONTINUE

	CONTINUE:
		mov EDX, OFFSET continuePrompt
		call WriteString
		call ReadChar
		mov continueInput, AL
		call crlf
		call crlf

		cmp continueInput, 'y'
		JE MENU

		mov EDX, OFFSET thankYouMsg
		call WriteString

exit
main ENDP
END main
