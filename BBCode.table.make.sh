#!/bin/sh

# i [iconPath]         Set icon for application
ICON='/Users/nico/Development/BBCodeApps/BBCode.table.icns'
# -a [name]            Set name of application bundle
APPNAME='BBCode.table_beta'
# -o [type]            Set output type.  See man page for accepted types
TYPE='Text\ Window'
# -p [interpreterPath] Set interpreter for script
INTERPRETER='/usr/bin/php'
# -V [version]         Set version of application
VERSION='2.1'
# -I [identifier]      Set bundle identifier (i.e. org.yourname.appname)
ID=com.nic-o.Bbcode.table
# -T [filetypes]       Set file type codes handled by application
FILETYPE='****|fold'
# -f [filePath]        Add a bundled file
ADDFILE='/Users/nico/Development/BBCodeApps/FileManager.php'
# -G [arguments]       Set arguments for script interpreter, separated by |
ARGS='-q'

MAIN='/Users/nico/Development/BBCodeApps/BBCode.table.php'



function CompileTable {
	/usr/local/bin/platypus -SD -i $ICON -a $APPNAME -o 'Text Window' -p $INTERPRETER -V $VERSION -I $ID -T $FILETYPE -f $ADDFILE -G $ARGS $MAIN './Build/'$APPNAME.app
}
function CreateProfile {
	/usr/local/bin/platypus -SD -i $ICON -a $APPNAME -o 'Text Window' -p $INTERPRETER -V $VERSION -I $ID -T $FILETYPE -f $ADDFILE -G $ARGS -O $APPNAME_$VERSION.platypus
}

#CompileTable
#CreateProfile

# Compile Bbcode[table].app
#-I com.nic-o.Bbcode.table-X '*' -T '****|fold' -f '/Users/nico/Development/BBCodeApps/FileManager.php' -G '-q'  '/Users/nico/Development/BBCodeApps/BBCode.table.php'