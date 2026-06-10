TITLE lab3.1c Program 1 : LOOP and ADD
; Author: Lam Yoke Yu & Tan Yi Ya
; Date: 27 June 2024
include Irvine32.inc

.data
	hexagonMsg BYTE "Calculate Perimeter 2-Hexagon (LOOP and ADD instructions) : ", 0
	inputPrompt1 BYTE "Input Hexagon 1 (side length) : ", 0
	inputPrompt2 BYTE "Input Hexagon 2 (side length) : ", 0
	resultStr BYTE "Result of Perimeter Hexagon 1 and 2 : ", 0
	totalStr BYTE "Total Perimeter Hexagon 1 and 2 : ", 0
	errorPrompt BYTE "Error: Please enter a valid integer.", 0
	sideHex1 DWORD ?
	sideHex2 DWORD ?
	perimeterHexagon1 DWORD 0
	perimeterHexagon2 DWORD 0
	totalPerimeter DWORD 0

.code
main proc
	mov EDX, OFFSET hexagonMsg
	call WriteString
	call crlf
	call crlf

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

	ADDITION:
		mov EAX, sideHex1
		add perimeterHexagon1, EAX
		mov EAX, sideHex2
		add perimeterHexagon2, EAX
		loop ADDITION

	; Display Results
	mov EDX, OFFSET resultStr
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

exit
main ENDP
END main